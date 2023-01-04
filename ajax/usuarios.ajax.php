<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

    //Editar usuarios
    public $idUsuario;
    public function ajaxEditarUsuario(){

        $item = "id_usuario";
        $valor = $this->idUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

        echo json_encode($respuesta);

    }

    // Activar usuario
    public $activarUsuario;
    public $activarId;
    public function ajaxActivarUsuario(){

        $tabla = "usuarios"; 

        $item1 = "estado"; 
        $valor1 = $this->activarUsuario; 
        
        $item2 = "id_usuario"; 
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

    }
    
    //Validar usuario
    public $validarUsuario;
    public function ajaxValidarUsuario(){

        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

        echo json_encode($respuesta);
    }

}

//Editar usuario enlace con ajax
if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}

// Activar Usuario
if(isset($_POST["activarUsuario"])){

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}

//Validar Usuario
if(isset($_POST["validarUsuario"])){

    $validarUsuario = new AjaxUsuarios();
    $validarUsuario -> validarUsuario = $_POST["validarUsuario"];
    $validarUsuario -> ajaxValidarUsuario();
}