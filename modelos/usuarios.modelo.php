<?php

require_once "conexion.php";

class ModeloUsuarios{

    static public function mdlMostrarUsuarios($tabla, $item, $valor){

        if($item != null){

            //$stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM usuarios a, usuarios_perfiles b WHERE a.perfil = b.perfil_id and $item = :$item");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
    
            return $stmt -> fetch();            
        }else{

            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM usuarios a, usuarios_perfiles b WHERE a.perfil = b.perfil_id");
            $stmt -> execute();
    
            return $stmt -> fetchAll();
        }

        $stmt = null;
    }

    static public function mdlIngresarUsuarios($tabla, $datos){

        $stmt = ConexionBD::conectar()->prepare("INSERT INTO $tabla(nombre, apellido_paterno, apellido_materno, usuario, password, perfil, foto)
        VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :usuario, :password, :perfil, :foto)");

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidoPaterno", $datos["apellidoPaterno"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidoMaterno", $datos["apellidoMaterno"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
        $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        
        if($stmt -> execute()){

            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }

    static public function mdlEditarUsuario($tabla, $datos){

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET nombre =:nombre, apellido_paterno =:apellidoPaterno,
        apellido_materno =:apellidoMaterno, password =:password, perfil =: perfil, foto =:foto WHERE usuario =:usuario");

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidoPaterno", $datos["apellidoPaterno"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidoMaterno", $datos["apellidoMaterno"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }
}