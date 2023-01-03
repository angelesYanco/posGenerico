<?php

class ControladorUsuarios{

    static public function ctrIngresoUsuarios(){

        if(isset($_POST["ingUsuario"])){

            if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) ||
                preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

                // Encriptar contraseña                
                $encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

                $tabla = "usuarios";

                $item = "usuario";
                $valor = $_POST["ingUsuario"];

                $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

                if($respuesta["usuario"] == $_POST["ingUsuario"] &&
                    $respuesta["password"] == $encriptar){

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id_usuario"];
                    $_SESSION["nombreCompleto"] = $respuesta["nombre"].' '.$respuesta["apellido_paterno"].' '.$respuesta["apellido_materno"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["foto"] = $respuesta["foto"];
                    $_SESSION["perfil"] = $respuesta["perfil"];

                    echo '<script>
                    
                        window.location = "inicio";
                    </script>';
                }else{

                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelva a intentarlo</div>';
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

                    $nuevoAncho = 50;
                    $nuevoAlto = 50;

                    // Creando el directorio para guardar la foto
                    $directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

                    if(!file_exists($directorio)){
                        mkdir($directorio, 0755);
                    }

                    // Damos tratamiento en base al tipo de imagen JPG
                    if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

                        $aleatorio = date("YmdHis");
                        $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."_".$aleatorio.".jpg";

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

                        $aleatorio = date("YmdHis");;
                        $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."_".$aleatorio.".png";

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
                        imagepng($destino, $ruta);
                    }

                }

                $tabla = "usuarios";

                // Encriptar contraseña
                $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');
                $datos = array(
                    "nombre" => $_POST["nuevoNombre"],
                    "apellidoPaterno" => $_POST["nuevoApellidoPaterno"],
                    "apellidoMaterno" => $_POST["nuevoApellidoMaterno"],
                    "usuario" => $_POST["nuevoUsuario"],
                    "password" => $encriptar,
                    "perfil" => $_POST["nuevoPerfil"],
                    "foto" => $ruta
                );

                $respuesta = ModeloUsuarios::mdlIngresarUsuarios($tabla, $datos);

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

    static public function ctrMostrarUsuario($item, $valor){

        $tabla = "usuarios";

        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

    // Editar Usuario
    static function ctrEditarUsuario(){

        if(isset($_POST["editarUsuario"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoPaterno"]) &&
            preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellidoMaterno"])){

                // Validar Imagen
                $ruta = $_POST["fotoActual"];

                if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){
                    
                    $directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

                    // Existe el directorio del usuario?
                    if(!file_exists($directorio)){
                        mkdir($directorio, 0755);
                    }
                    
                    // Existe foto del usario?
                    if(!empty($_POST["fotoActual"])){

                        if(!file_exists($_POST["fotoActual"])){

                            unlink($_POST["fotoActual"]);
                        }                   
                    }

                    // Obtener ancho y largo
                    list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                    $nuevoAncho = 50;
                    $nuevoAlto = 50;

                    // Damos tratamiento en base al tipo de imagen JPG
                    if($_FILES["editarFoto"]["type"] == "image/jpeg"){

                        $aleatorio = date("YmdHis");
                        $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."_".$aleatorio.".jpg";

                        $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
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
                    if($_FILES["editarFoto"]["type"] == "image/png"){

                        $aleatorio = date("YmdHis");
                        $ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."_".$aleatorio.".png";

                        $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
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
                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "usuarios";

                if($_POST["editarPassword"] != ""){

                    if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

                        $encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');
                    }else{

                        echo 
                        '<script>

                            swal({
                                type: "error",
                                title: "¡La contraseña no puede ir vacia o llevar caracteres especiales!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            }).then((result) => {
                                if(result.value){
                                    
                                    window.location = "usuarios";
                                }

                            });

                        </script>';
                    }                    
                }else{

                    $encriptar = $_POST["passwordActual"];
                }

                $datos = array(
                    "usuario" => $_POST["editarUsuario"], 
                    "nombre" => $_POST["editarNombre"],
                    "apellidoPaterno" => $_POST["editarApellidoPaterno"],
                    "apellidoMaterno" => $_POST["editarApellidoMaterno"],
                    "password" => $encriptar,
                    "perfil" => $_POST["editarPerfil"],
                    "foto" => $ruta
                );

                var_dump($datos);

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if($respuesta == "ok"){

                    echo 
                    '<script>

                        swal({
                            type: "success",
                            title: "¡El usuario ha sido editado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result) => {
                            if(result.value){
                                
                                window.location = "usuarios";
                            }
                        });

                    </script>';

                }else{
                    
                    echo 
                    '<script>

                        swal({
                            type: "error",
                            title: "¡No se actualizo el usuario, revise sus datos!"'.$respuesta.',
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }).then((result) => {
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
                        title: "¡El nombre de usuario no puede ir vacio o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false
                    }).then((result) => {
                        if(result.value){
                            
                            window.location = "usuarios";
                        }
    
                    });
    
                </script>';
                
            }
        }
    }
}