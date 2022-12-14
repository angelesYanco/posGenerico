<?php

require_once "conexion.php";

class ModeloCategorias{

    static public function mdlIngresarCategoria($tabla, $datos){

        $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES (:categoria)");

        $stmt -> bindParam(":categoria", $datos, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    } 

    static public function mdlMostrarCategorias($tabla, $item, $valor){

        if($item != null){

            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla FROM $item = :$item");

            $stmt -> bindParam(":".$item, $ivalor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;
    }
}