<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\Productos as DaoProductos;
use Views\Renderer;

class Productos extends PublicController{

    /**
     * Runs the controller
     * 
     * @return void
     */
    public function run():void{
        //code
        $viewData = array();
        $viewData["Productos"] = DaoProductos::getAll();

        Renderer::render('mnt/Productos', $viewData);
    }
}

?>
