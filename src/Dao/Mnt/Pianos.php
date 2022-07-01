<?php

namespace Dao\Mnt;

use Dao\Table;

/**
 * Modelo de Datos para la tabla pianos
 * 
 * @category Data_Model
 * @package Dao.table
 * @author Jorge A. Ayala
 * @license Comercial http://
 * 
 * @link http://url.com
 */
class Pianos extends Table{
    /*

    CREATE TABLE `pianos` (
    `pianoid` BIGINT(18) NOT NULL AUTO_INCREMENT,
    `pianodsc` VARCHAR(60) NULL,
    `pianobio` VARCHAR(5000) NULL,
    `pianosales` INT NULL,
    `pianoimguri` VARCHAR(128) NULL,
    `pianoimgthb` VARCHAR(128) NULL,
    `pianoprice` DECIMAL(13,2) NULL,
    `pianoest` CHAR(3) NULL,
    PRIMARY KEY (`pianoid`));
    */

    /**
     * Obtiene todo los pianos
     * 
     * @return array
     */
    public static function getAll(){
        $sqlstr = "SELECT * FROM pianos;";

        return self::obtenerRegistros($sqlstr, array());
    }
    /**
     * Get Producto By Id
     *
     * @param int $pianoid Codigo del piano
     *
     * @return array
     */
    public static function getById(int $pianoid)
    {
        $sqlstr = "SELECT * from `pianos` where pianoid=:pianoid;";
        $sqlParams = array("pianoid" => $pianoid);
        return self::obtenerUnRegistro($sqlstr, $sqlParams);
    }

    /**
     * Insert into Pianos
     *
     * @param [type] $pianodsc      description
     * @param [type] $pianobio      description
     * @param [type] $pianosales    description
     * @param [type] $pianoimguri   description
     * @param [type] $pianoimgthb   description
     * @param [type] $pianoprice    description
     * @param [type] $pianoest      description
     *
     * @return void
     */
    public static function insert(
        $pianodsc,
        $pianobio,
        $pianosales,
        $pianoimguri,
        $pianoimgthb,
        $pianoprice,
        $pianoest
    ){
        $sqlstr = "INSERT INTO `pianos`
        (pianodsc, pianobio, pianosales, pianoimguri, 
        pianoimgthb, pianoprice, pianoest)
        VALUES
        (:pianodsc, :pianobio, :pianosales, :pianoimguri, 
        :pianoimgthb, :pianoprice, :pianoest);";
        $sqlParams = [
            "pianodsc" => $pianodsc,
            "pianobio" => $pianobio,
            "pianosales" => $pianosales,
            "pianoimguri" => $pianoimguri,
            "pianoimgthb" => $pianoimgthb,
            "pianoprice" => $pianoprice,
            "pianoest" => $pianoest
        ];

        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Updates Pianos
     *
     * @param [type] $pianodsc      description
     * @param [type] $pianobio      description
     * @param [type] $pianosales    description
     * @param [type] $pianoimguri   description
     * @param [type] $pianoimgthb   description
     * @param [type] $pianoprice    description
     * @param [type] $pianoest      description
     * @param [type] $pianoid       description
     *
     * @return void
     */
    public static function update(
        $pianodsc,
        $pianobio,
        $pianosales,
        $pianoimguri,
        $pianoimgthb,
        $pianoprice,
        $pianoest,
        $pianoid
    ) {
        $sqlstr = "UPDATE `pianos` set
        `pianodsc`=:pianodsc, `pianobio`=:pianobio,
        `pianosales`=:pianosales, `pianoimguri`=:pianoimguri, `pianoimgthb`=:pianoimgthb,
        `pianoprice`=:pianoprice, `pianoest`=:pianoest
        where `pianoid` = :pianoid ;";
        $sqlParams = array(
            "pianodsc" => $pianodsc,
            "pianobio" => $pianobio,
            "pianosales" => $pianosales,
            "pianoimguri" => $pianoimguri,
            "pianoimgthb" => $pianoimgthb,
            "pianoprice" => $pianoprice,
            "pianoest" => $pianoest,
            "pianoid" => $pianoid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

    /**
     * Delete a piano
     *
     * @param [type] $pianoid description
     *
     * @return void
     */
    public static function delete($pianoid)
    {
        $sqlstr = "DELETE from `pianos` where pianoid = :pianoid;";
        $sqlParams = array(
            "pianoid" => $pianoid
        );
        return self::executeNonQuery($sqlstr, $sqlParams);
    }

}

?>