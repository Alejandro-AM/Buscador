<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Dao\Mnt\Pianos as DaoPianos;
use Views\Renderer;

class Pianos extends PublicController{

    /**
     * Runs the controller
     * 
     * @return void
     */
    public function run():void{
        //code
        $viewData = array();
        $viewData["Pianos"] = DaoPianos::getAll();

        Renderer::render('mnt/Pianos', $viewData);
    }
}

?>