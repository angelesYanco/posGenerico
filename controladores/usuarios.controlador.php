<?php

class ControladorUsuarios{

    static public function ctrIngresoUsuarios(){

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

    static public function ctrCrearUsuario(){

        if(isset($_POST["nuevoUsuario"])){
        
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoPaterno"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellidoMaterno"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
            preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"]) ){

                $tabla = "usuarios";
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "apellidoPaterno" => $_POST["nuevoApellidoPaterno"],
                    "apellidoMaterno" => $_POST["nuevoApellidoMaterno"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $_POST["nuevoPassword"],
                    "perfil" => $_POST["nuevoPerfil"],
                );

                $respuesta = ModeloUsuarios::mdIngresarUsuarios($tabla, $datos);

                if($respuesta == "ok"){

                    echo 
                        '<script>
                        
                            swal({

                                type: "success",
                                title: "¡El usuaroi ha sido cargado correctamente!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false

                            }).then(function(result){

                                if(result.value){

                                    window.location = "usuarios";
                                }

                            });

                        </script>';
                }

                
            }else{

                echo 
                '<script>
                
                    swal({

                        type: "error",
                        title: "¡Los campos Nombre, Apellidos\ny Usuario no puede ir vacios\no llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then(function(result){

                        if(result.value){

                            window.location = "usuarios";
                        }

                    });

                </script>';
            }
        }
    }
}