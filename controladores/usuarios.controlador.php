<?php

class ControladorUsuarios{

    public function ctrIngresoUsuarios(){

        if(isset($_POST["ingUsuario"])){

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) ||
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
                    
                $tabla = "usuarios";
                $item = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                var_dump($respuesta["usuario"]);
                

                // if($respuesta("usuario") == $_POST["ingUsuaro"] &&
                //     $respuesta("password") == $_POST["ingPassword"]){

                //     echo '<br><div class"alert alert-success">Bien vendo al sistema.</div>';
                // }else{

                //     echo '<br><div class"alert alert-danger">Error al ingresar, vuelva a intentarlo</div>';
                // }
            }
        }
    }
}