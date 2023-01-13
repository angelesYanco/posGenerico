<?php

class ControladorCategorias{

    static public function ctrCrearCategoria(){

        if(isset($_POST["nuevaCategoria"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

                $tabla = "categorias";
                $datos = $_POST["nuevaCategoria"];

                $respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>
                        swal({
                            type: "success",
                            title: "La categoria ha sido guardada correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            }).then((result) => {
                                if(result.value){
                                    window.location = "categorias";
                                }
                            })
                    </script>';
                }else{

                    echo '<script>
                    swal({
                        type: "error",
                        title: "¡La categoria no se actualizo, revise sus datos!",
                        showConfirmButton: true,
                        closeOnConfirm: false
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        })
                    </script>';
                    
                }
            }else{

                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La categoria no puede ir vacia o llevar caracteres especiales!",
                        showConfirmButton: true,
                        closeOnConfirm: false
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        })
                </script>';
            }
        }
        
    }

    static public function ctrMostrarCategorias($item, $valor){

        $tabla = "categorias";

        $respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

        return $respuesta;
    }

    static public function ctrEditarCategoria(){
        
        if(isset($_POST["editarCategoria"])){
            
            echo '<p>Hola</p>';

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

                $tabla = "categorias";
                $datos = array("categoria"=>$_POST["editarCategoria"],
                                "id_categoria"=>$_POST["idCategoria"]);

                $respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);
      
                

                if($respuesta == "ok"){
                    
                    print('<p>Hola</p>');

                    echo "<script>
                        swal({
                            type: 'success',
                            title: 'La categoria ha sido actualizada.',
                            showConfirmButton: true,
                            confirmButtonText: 'Cerrar',
                            closeOnConfirm: false
                            }).then((result) => {
                                if(result.value){
                                    window.location = 'categorias';
                                }
                            })
                    </script>";
                }else{
                    echo '<script>
                        swal({
                            type: "error",
                            title: "¡La categoria no se actualizo, revise sus datos!",
                            showConfirmButton: true,
                            closeOnConfirm: false
                            }).then((result) => {
                                if(result.value){
                                    window.location = "categorias";
                                }
                            })
                        </script>';
                }                
            }else{

                echo '<script>
                    swal({
                        type: "error",
                        title: "¡La categoria no puede ir vacia o llevar caracteres especiales!",
                        showConfirmButton: true,
                        closeOnConfirm: false
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        })
                </script>';
            }
        }        
    }
}