/* Subiendo la foto del usuario */

$(".nuevaFoto").change(function(){

    var imagen = this.files[0];
    //console.log("imagen", imagen);

    //Valida extensiones permitidas
    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

        $(".nuevaFoto").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen debe estar en formato JPG o PNG!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }else if(imagen["size"] > 2000000){

        $(".nuevaFoto").val("");

        swal({

            title: "Error al subir la imagen",
            text: "¡La imagen no debe de pesar mas de 2 MB!",
            type: "error",
            confirmButtonText: "¡Cerrar!"

        });

    }else{

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);

        $(datosImagen).on("load", function(event){

            var rutaImagen = event.target.result;

            $(".previsualizar").attr("src", rutaImagen);
        })
    }
});

// const btnEditar = document.querySelector('.btnEditarUsuario');
// btnEditar.addEventListener('click', function(evento){

//     console.log(evento);
//     evento.preventDefault();
//     console.log('Enviando Formulario');
// });

// Editar usuario
$(".btnEditarUsuario").click(function(){

    var idUsuario = $(this).attr("idUsuario");
    //console.log("idUsuarios", idUsuario);

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $("#editarNombre").val(respuesta["nombre"]);
            $("#editarApellidoPaterno").val(respuesta["apellido_paterno"]);
            $("#editarApellidoMaterno").val(respuesta["apellido_materno"]);
            $("#editarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil_nombre"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);


            $("#passwordActual").val(respuesta["password"]);

            if(respuesta["foto"] != ""){

                $(".previsualizar").attr("src", respuesta["foto"]);
            } 
        }
    })
});