<?php

require_once "conexion.php";

class ModeloUsuarios{

    static public function mdlMostrarUsuarios($tabla, $item, $valor){

        $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt = null;
    }

    static public function mdIngresarUsuarios($tabla, $datos){

        $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla(nombre, apellido_paterno, apellido_materno, usuario, password, perfil)
        VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :usuario, :password, :perfil)");

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidoPaterno", $datos["apellidoPaterno"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidoMaterno", $datos["apellidoMaterno"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
        
        if($stmt -> execute()){

            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }
}