<?php

namespace Dao\Mnt;

use Dao\Table;

/**
 * Modelo de Datos para la tabla productos
 * 
 * @category Data_Model
 * @package Dao.table
 * @author Jorge A. Ayala
 * @license Comercial http://
 * 
 * @link http://url.com
 */
class Productos extends Table{
    /*

    `invPrdId` bigint(13) NOT NULL AUTO_INCREMENT,
    `invPrdBrCod` varchar(128) DEFAULT NULL,
    `invPrdCodInt` varchar(128) DEFAULT NULL,
    `invPrdDsc` varchar(128) DEFAULT NULL,
    `invPrdTip` char(3) DEFAULT NULL,
    `invPrdEst` char(3) DEFAULT NULL,
    `invPrdPadre` bigint(13) DEFAULT NULL,
    `invPrdFactor` int(11) DEFAULT NULL,
    `invPrdVnd` char(3) DEFAULT NULL,

    */

    /**
     * Obtiene todo los productos
     * 
     * @return array
     */
    public static function getAll(){
        $sqlstr = "SELECT * FROM productos;";

        return self::obtenerRegistros($sqlstr, array());
    }

    public static function getByDescription($filtro){
        $sqlstr = "SELECT * FROM productos WHERE invPrdDsc LIKE :filtro;";
        $sqlParams = array("filtro" => "%".$filtro."%");

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    public static function getByRange($min, $max){
        $sqlstr = "SELECT * FROM productos WHERE invPrdPrice between :min and :max ;";
        $sqlParams = array("min" => $min, "max" => $max);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    public static function getByDescRang($filtro, $min, $max){
        $sqlstr = "SELECT * FROM productos WHERE invPrdDsc LIKE :filtro AND invPrdPrice between :min and :max ;";
        $sqlParams = array("filtro" => "%".$filtro."%", "min" => $min, "max" => $max);

        return self::obtenerRegistros($sqlstr, $sqlParams);
    }

    /**
     * Get Producto By Id
     *
     * @param int $invPrdId Codigo del Producto
     *
     * @return array
     */
    public static function getById(int $invPrdId)
    {
        $sqlstr = "SELECT * from `productos` where invPrdId=:invPrdId;";
        $sqlParams = array("invPrdId" => $invPrdId);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Insert into Productos
     *
     * @param [type] $invPrdBrCod  description
     * @param [type] $invPrdCodInt description
     * @param [type] $invPrdDsc    description
     * @param [type] $invPrdTip    description
     * @param [type] $invPrdEst    description
     * @param [type] $invPrdPadre  description
     * @param [type] $invPrdFactor description
     * @param [type] $invPrdVnd    description
     *
     * @return void
     */
    public static function insert(
        $invPrdBrCod,
        $invPrdCodInt,
        $invPrdDsc,
        $invPrdTip,
        $invPrdEst,
        $invPrdPadre,
        $invPrdFactor,
        $invPrdVnd
    ){
        $sqlstr = "INSERT INTO `productos`
        (`invPrdBrCod`, `invPrdCodInt`, `invPrdDsc`, `invPrdTip`, 
        `invPrdEst`, `invPrdPadre`, `invPrdFactor`, `invPrdVnd`)
        VALUES
        (:invPrdBrCod , :invPrdCodInt, :invPrdDsc, :invPrdTip,
        :invPrdEst, :invPrdPadre, :invPrdFactor, :invPrdVnd);";
        $sqlParams = [
            "invPrdBrCod" => $invPrdBrCod,
            "invPrdCodInt" => $invPrdCodInt,
            "invPrdDsc" => $invPrdDsc,
            "invPrdTip" => $invPrdTip,
            "invPrdEst" => $invPrdEst,
            "invPrdPadre" => $invPrdPadre,
            "invPrdFactor" => $invPrdFactor,
            "invPrdVnd" => $invPrdVnd
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Updates productos
     *
     * @param [type] $invPrdBrCod  description
     * @param [type] $invPrdCodInt description
     * @param [type] $invPrdDsc    description
     * @param [type] $invPrdTip    description
     * @param [type] $invPrdEst    description
     * @param [type] $invPrdPadre  description
     * @param [type] $invPrdFactor description
     * @param [type] $invPrdVnd    description
     * @param [type] $invPrdId     description
     *
     * @return void
     */
    public static function update(
        $invPrdBrCod,
        $invPrdCodInt,
        $invPrdDsc,
        $invPrdTip,
        $invPrdEst,
        $invPrdPadre,
        $invPrdFactor,
        $invPrdVnd,
        $invPrdId
    ) {
        $sqlstr = "UPDATE `productos` set
        `invPrdBrCod`=:invPrdBrCod, `invPrdCodInt`=:invPrdCodInt,
        `invPrdDsc`=:invPrdDsc, `invPrdTip`=:invPrdTip, `invPrdEst`=:invPrdEst,
        `invPrdPadre`=:invPrdPadre, `invPrdFactor`=:invPrdFactor, `invPrdVnd`=:invPrdVnd
        where `invPrdId` = :invPrdId;";
        $sqlParams = array(
            "invPrdBrCod" => $invPrdBrCod,
            "invPrdCodInt" => $invPrdCodInt,
            "invPrdDsc" => $invPrdDsc,
            "invPrdTip" => $invPrdTip,
            "invPrdEst" => $invPrdEst,
            "invPrdPadre" => $invPrdPadre,
            "invPrdFactor" => $invPrdFactor,
            "invPrdVnd" => $invPrdVnd,
            "invPrdId" => $invPrdId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Undocumented function
     *
     * @param [type] $invPrdId description
     *
     * @return void
     */
    public static function delete($invPrdId)
    {
        $sqlstr = "DELETE from `productos` where invPrdId = :invPrdId;";
        $sqlParams = array(
            "invPrdId" => $invPrdId
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}

?>
