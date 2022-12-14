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

                //var_dump($respuesta["usuario"]);
                
                if($respuesta["usuario"] == $_POST["ingUsuario"] &&
                    $respuesta["password"] == $_POST["ingPassword"]){

                    $_SESSION["iniciarSesion"] = "ok";

                    echo '<script>
                    
                        window.location = "inicio";
                    </script>';
                }else{

                    echo '<br><div class"alert alert-danger">Error al ingresar, vuelva a intentarlo</div>';
                }
            }
        }
    }
}