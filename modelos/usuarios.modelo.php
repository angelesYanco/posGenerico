<?php

require_once "conexion.php";

class ModeloUsuarios{

    public $query = "";

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

        try{
            $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, apellido_paterno = :apellidoPaterno,
            apellido_materno = :apellidoMaterno, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
    
            // $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            // $stmt -> bindParam(":apellidoPaterno", $datos["apellidoPaterno"], PDO::PARAM_STR);
            // $stmt -> bindParam(":apellidoMaterno", $datos["apellidoMaterno"], PDO::PARAM_STR);
            // $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
            // $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
            // $stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
            // $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

            $stmt -> bindValue(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt -> bindValue(":apellidoPaterno", $datos["apellidoPaterno"], PDO::PARAM_STR);
            $stmt -> bindValue(":apellidoMaterno", $datos["apellidoMaterno"], PDO::PARAM_STR);
            $stmt -> bindValue(":password", $datos["password"], PDO::PARAM_STR);
            $stmt -> bindValue(":perfil", $datos["perfil"], PDO::PARAM_INT);
            $stmt -> bindValue(":foto", $datos["foto"], PDO::PARAM_STR);
            $stmt -> bindValue(":usuario", $datos["usuario"], PDO::PARAM_STR);
    
            $query = $stmt->queryString;

            var_dump($query);
    
            if($stmt->execute()){
    
                return "ok";
            }
        }
        catch (Exception $e){
            echo "Error: ".$e->getMessage()."\n";            
        }

        $stmt = null;
    }

    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){
 
        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindValue(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindValue(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt->execute()){
    
            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }
}