<?php

require_once "conexion.php";

class ModeloUsuarios{

    public $query = "";

    static public function mdlMostrarUsuarios($tabla, $item, $valor){

        if($item != null){

            //$stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM usuarios a, usuarios_perfiles b WHERE a.perfil = b.perfil_id and $item = :$item and a.estado >= 0");
            
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
    
            return $stmt -> fetch();            
        }else{

            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM usuarios a, usuarios_perfiles b WHERE a.perfil = b.perfil_id and estado >= 0");
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

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        if($stmt->execute()){
    
            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }

    static public function mdlActivarUsuario($tabla, $item1, $valor1, $item2, $valor2, $item3, $valor3){
 
        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item3 = :$item3 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);

        if($stmt->execute()){
    
            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }

    static public function mdlBorrarUsuario($tabla, $datos){

        date_default_timezone_set('America/Mexico_City');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $fechaActual = $fecha.' '.$hora;

        $item1 = "estado";
        $valor1 = "-1";

        $item2 = "fecha_baja";
        $valor2 = $fechaActual;

        $item3 = "id_usuario";
        $valor3 = $datos;

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1, $item2 = :$item2 WHERE $item3 = :$item3");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item3, $valor3, PDO::PARAM_STR);

        if($stmt->execute()){
    
            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
       
    }
}