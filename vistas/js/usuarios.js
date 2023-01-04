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

//Activar usuario
$(".btnActivar").click(function(){

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

            
        }
    });

    if(estadoUsuario == 0){

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('estadoUsuario', 1);
    }else{

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('estadoUsuario', 0);
    }
});

// Validar usuario unico
$("#nuevoUsuario").change(function(){

    $(".alert").remove();

    var usuario = $(this).val();

    var datos =  new FormData();
    datos.append("validarUsuario", usuario);

    $.ajax({

        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cahce: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            //console.log("respuesta", respuesta);
            if(respuesta){

                $("#nuevoUsuario").parent().after('<div class="alert alert-warning">El usuario ' + usuario + ' ya existe en la base de datos!</div>')
                $("#nuevoUsuario").val('');
            }
        }
    });
});