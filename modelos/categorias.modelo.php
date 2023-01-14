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

            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $stmt = ConexionBD::conectar()->prepare("SELECT * FROM $tabla WHERE estado >= 0");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt = null;
    }

    static public function mdlEditarCategoria($tabla, $datos){

        date_default_timezone_set('America/Mexico_City');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $fechaActual = $fecha.' '.$hora;

        $respuesta = "";

        try{

            $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET categoria= :categoria, fecha_actualizacion = :fecha_actualizacion WHERE id_categoria= :id_categoria");

            $stmt -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
            $stmt -> bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_STR);
            $stmt -> bindParam(":fecha_actualizacion", $fechaActual, PDO::PARAM_STR);

            $stmt->execute();
            
            $respuesta = "ok";

        }catch(Exception $e){

            $respuesta = 'Message: '.$e -> getMessage();
        }

        $stmt = null;
        
        return $respuesta;
    }

    static public function mdlBorrarCategoria($tabla, $datos){

        date_default_timezone_set('America/Mexico_City');

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $fechaActual = $fecha.' '.$hora;

        $stmt = ConexionBD::conectar()->prepare("UPDATE $tabla SET estado = -1, fecha_baja = :fecha_baja WHERE id_categoria= :id_categoria");

        $stmt -> bindParam(":id_categoria", $datos, PDO::PARAM_INT);
        $stmt -> bindParam(":fecha_baja", $fechaActual, PDO::PARAM_STR);

        if($stmt->execute()){

            return "ok";
        }else{

            return "error";
        }

        $stmt = null;
    }
}