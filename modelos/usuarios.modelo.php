<?php

require_once "conexion.php";

class ModeloUsuarios extends ConexionBD{

    static public function mdlMostrarUsuarios($tabla, $item, $valor){

        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();
    }
}