<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\Productos as DaoProductos;
use Views\Renderer;

class Buscador extends PublicController{

    /**
     * Runs the controller
     * 
     * @return void
     */
    public function run():void{
        //code
        $viewData = array();

        // Cuando es método GET 
        if (!$this->isPostBack()) {
            $viewData["Productos"] = DaoProductos::getAll();
            $viewData["min"] = 0;
            $viewData["max"] = 0;
        }
        // Cuando es método POST 
        if ($this->isPostBack()) {
            if(isset($_POST["btnBuscar"])){
                if($_POST["filtrar"] == "DSC"){
                    $viewData["Productos"] = DaoProductos::getByDescription($_POST["filter"]);
                    $viewData["desc"] = $_POST["filter"];
                    $viewData["min"] = 0;
                    $viewData["max"] = 0;
                    $viewData["isCheckedDsc"] = true;
                }
                else if($_POST["filtrar"] == "RNG"){
                    $viewData["Productos"] = DaoProductos::getByRange($_POST["rangoMin"], $_POST["rangoMax"]);
                    $viewData["desc"] = "";
                    $viewData["min"] = $_POST["rangoMin"];
                    $viewData["max"] = $_POST["rangoMax"];
                    $viewData["isCheckedRng"] = true;
                }
                else if($_POST["filtrar"] == "DR"){
                    $viewData["Productos"] = DaoProductos::getByDescRang($_POST["filter"], $_POST["rangoMin"], $_POST["rangoMax"]);
                    $viewData["desc"] = $_POST["filter"];
                    $viewData["min"] = $_POST["rangoMin"];
                    $viewData["max"] = $_POST["rangoMax"];
                    $viewData["isCheckedDR"] = true;
                }
                
            }
        }
        Renderer::render('mnt/Buscador', $viewData);
    }
}

?>