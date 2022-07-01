<?php

namespace Controllers\Mnt;

use Controllers\PublicController;
use Views\Renderer;
use Utilities\Validators;
use Dao\Mnt\Pianos;

class Piano extends PublicController{

    private $viewData = array();
    private $arrModeDesc = array();
    private $arrEstados = array();

    /**
     * Runs the controller
     * 
     * @return void
     */
    public function run():void
    {
        // code
        $this->init();
        // Cuando es método GET (se llama desde la lista)
        if (!$this->isPostBack()) {
            $this->procesarGet();
        }
        // Cuando es método POST (click en el botón)
        if ($this->isPostBack()) {
            $this->procesarPost();
        }
        // Ejecutar Siempre
        $this->processView();
        Renderer::render('mnt/piano', $this->viewData);
    }

    private function init()
    {
        $this->viewData = array();
        $this->viewData["mode"] = "";
        $this->viewData["mode_desc"] = "";
        $this->viewData["crsf_token"] = "";
        $this->viewData["pianoid"] = "";
        $this->viewData["pianodsc"] = "";
        $this->viewData["error_pianodsc"] = array();
        $this->viewData["pianobio"] = "";
        $this->viewData["error_pianobio"] = array();
        $this->viewData["pianosales"] = "";
        $this->viewData["error_pianosales"] = array();
        $this->viewData["pianoimguri"] = "";
        $this->viewData["error_pianoimguri"] = array();
        $this->viewData["pianoimgthb"] = "";
        $this->viewData["error_pianoimgthb"] = array();
        $this->viewData["pianoprice"] = "";
        $this->viewData["error_pianoprice"] = array();
        $this->viewData["pianoest"] = "";
        $this->viewData["pianoEstArr"] = array();
        $this->viewData["btnEnviarText"] = "Guardar";
        $this->viewData["readonly"] = false;
        $this->viewData["showBtn"] = true;

        $this->arrModeDesc = array(
            "INS"=>"Nuevo Piano",
            "UPD"=>"Editando %s %s",
            "DSP"=>"Detalle de %s %s",
            "DEL"=>"Eliminado %s %s"
        );

        $this->arrEstados = array(
            array("value" => "ACT", "text" => "Activo"),
            array("value" => "INA", "text" => "Inactivo"),
        );

        $this->viewData["pianoEstArr"] = $this->arrEstados;

    }

    private function procesarGet()
    {
        if (isset($_GET["mode"])) {
            $this->viewData["mode"] = $_GET["mode"];
            if (!isset($this->arrModeDesc[$this->viewData["mode"]])) {
                error_log('Error: (Piano) Mode solicitado no existe.');
                \Utilities\Site::redirectToWithMsg(
                    "index.php?page=mnt_Pianos",
                    "No se puede procesar su solicitud!"
                );
            }
        }
        if ($this->viewData["mode"] !== "INS" && isset($_GET["id"])) {
            $this->viewData["pianoid"] = intval($_GET["id"]);
            $tmpPianos = Pianos::getById($this->viewData["pianoid"]);
            error_log(json_encode($tmpPianos));
            \Utilities\ArrUtils::mergeFullArrayTo($tmpPianos, $this->viewData);
        }
    }
    private function procesarPost()
    {
        // Validar la entrada de Datos
        //  Todos valor puede y sera usando en contra del sistema
        $hasErrors = false;
        \Utilities\ArrUtils::mergeArrayTo($_POST, $this->viewData);
        if (isset($_SESSION[$this->name . "crsf_token"])
            && $_SESSION[$this->name . "crsf_token"] !== $this->viewData["crsf_token"]
        ) {
            \Utilities\Site::redirectToWithMsg(
                "index.php?page=mnt_Pianos",
                "ERROR: Algo inesperado sucedió con la petición Intente de nuevo."
            );
        }

        if (Validators::IsEmpty($this->viewData["pianodsc"])) {
            $this->viewData["error_pianodsc"][]
                = "La descripción es requerida";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["pianobio"])) {
            $this->viewData["error_pianobio"][]
                = "La biografia es requerida";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["pianosales"])) {
            $this->viewData["error_pianosales"][]
                = "El numero de ventas es requerido";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["pianoimguri"])) {
            $this->viewData["error_pianoimguri"][]
                = "La url es requerida";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["pianoimgthb"])) {
            $this->viewData["error_pianoimgthb"][]
                = "La url es requerida";
            $hasErrors = true;
        }
        if (Validators::IsEmpty($this->viewData["pianoprice"])) {
            $this->viewData["error_pianoprice"][]
                = "El precio es requerido";
            $hasErrors = true;
        }
        error_log(json_encode($this->viewData));
        // Ahora procedemos con las modificaciones al registro
        if (!$hasErrors) {
            $result = null;
            switch($this->viewData["mode"]) {
            case 'INS':
                $result = Pianos::insert(
                    $this->viewData["pianodsc"],
                    $this->viewData["pianobio"],
                    $this->viewData["pianosales"],
                    $this->viewData["pianoimguri"],
                    $this->viewData["pianoimgthb"],
                    $this->viewData["pianoprice"],
                    $this->viewData["pianoest"]
                );
                if ($result) {
                        \Utilities\Site::redirectToWithMsg(
                            "index.php?page=mnt_Pianos",
                            "Piano guardado Satisfactoriamente!"
                        );
                }
                break;
            case 'UPD':
                $result = Pianos::update(
                    $this->viewData["pianodsc"],
                    $this->viewData["pianobio"],
                    $this->viewData["pianosales"],
                    $this->viewData["pianoimguri"],
                    $this->viewData["pianoimgthb"],
                    $this->viewData["pianoprice"],
                    $this->viewData["pianoest"],
                    intval($this->viewData["pianoid"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_Pianos",
                        "Piano Actualizado Satisfactoriamente"
                    );
                }
                break;
            case 'DEL':
                $result = Pianos::delete(
                    intval($this->viewData["pianoid"])
                );
                if ($result) {
                    \Utilities\Site::redirectToWithMsg(
                        "index.php?page=mnt_Pianos",
                        "Piano Eliminado Satisfactoriamente"
                    );
                }
                break;
            }
        }
    }

    private function processView()
    {
        if ($this->viewData["mode"] === "INS") {
            $this->viewData["mode_desc"]  = $this->arrModeDesc["INS"];
            $this->viewData["btnEnviarText"] = "Guardar Nuevo";
        } else {
            $this->viewData["mode_desc"]  = sprintf(
                $this->arrModeDesc[$this->viewData["mode"]],
                $this->viewData["pianoid"],
                $this->viewData["pianodsc"]
            );
            $this->viewData["pianoEstArr"]
                = \Utilities\ArrUtils::objectArrToOptionsArray(
                    $this->arrEstados,
                    'value',
                    'text',
                    'value',
                    $this->viewData["pianoest"]
                );
            if ($this->viewData["mode"] === "DSP") {
                $this->viewData["readonly"] = true;
                $this->viewData["showBtn"] = false;
            }
            if ($this->viewData["mode"] === "DEL") {
                $this->viewData["readonly"] = true;
                $this->viewData["btnEnviarText"] = "Eliminar";
            }
            if ($this->viewData["mode"] === "UPD") {
                $this->viewData["btnEnviarText"] = "Actualizar";
            }
        }
        $this->viewData["crsf_token"] = md5(getdate()[0] . $this->name);
        $_SESSION[$this->name . "crsf_token"] = $this->viewData["crsf_token"];
    }
}

?>
