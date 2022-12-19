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

                $ruta = "";

                // Validar imagenes
                if(isset($_FILES["nuevaFoto"]["tmp_name"])){

                    // Obtener ancho y largo
                    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;

                    // Creando el directorio para guardar la foto
                    $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

                    if(!file_exists($directorio)){
                        mkdir($directorio, 0755);
                    }

                    // Damos tratamiento en base al tipo de imagen JPG
                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized(
                            $destino,
                            $origen,
                            0,
                            0,
                            0,
                            0,
                            $nuevoAncho,
                            $nuevoAlto,
                            $ancho,
                            $alto
                        );
                        imagejpeg($destino, $ruta);
                    }

                    // Damos tratamiento en base al tipo de imagen PNG
                    if($_FILES["nuevaFoto"]["type"] == "image/png"){

                        $aleatorio = mt_rand(100, 999);
                        $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagecopyresized(
                            $destino,
                            $origen,
                            0,
                            0,
                            0,
                            0,
                            $nuevoAncho,
                            $nuevoAlto,
                            $ancho,
                            $alto
                        );
                        imagejpeg($destino, $ruta);
                    }

                }

                $tabla = "usuarios";
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "apellidoPaterno" => $_POST["nuevoApellidoPaterno"],
                    "apellidoMaterno" => $_POST["nuevoApellidoMaterno"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $_POST["nuevoPassword"],
                    "perfil" => $_POST["nuevoPerfil"],
                    "foto" => $ruta
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