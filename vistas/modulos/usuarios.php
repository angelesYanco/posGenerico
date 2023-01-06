<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar usuarios
    </h1>

    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      <li class="active">Administrar usuarios</li>
    </ol>
  </section>

  <!-- Main content: Tabla con los datos de los usuarios -->
  <section class="content">

    <!-- Default box -->
    <div class="box">

      <!-- Agregar usuario -->
      <div class="box-header with-border">
      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
        Agregar usuario
      </button>
      </div>

      <!-- Detalle de usuarios -->
      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Nombre completo</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $item = null;
              $valor = null;

              $usuarios = ControladorUsuarios::ctrMostrarUsuario($item, $valor);

              foreach($usuarios as $key => $value){

                echo 
                  '<tr>
                  <td>'.$value["id_usuario"].'</td>
                  <td>'.$value["nombre"].' '.$value["apellido_paterno"].' '.$value["apellido_materno"].'</td>
                  <td>'.$value["usuario"].'</td>';
                
                if($value["foto"] != ""){

                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width=""></td>';
                }else{
                  echo '<td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width=""></td>';
                }
                
                echo
                  '<td>'.$value["perfil_nombre"].'</td>';

                if($value["estado"] != 0){
                  
                  echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id_usuario"].'" estadoUsuario="0">Activado</button></td>';
                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id_usuario"].'" estadoUsuario="1">Desactivado</button></td>';                  
                }
                  
                echo '<td>'.$value["fecha_ultimo_login"].'</td>';

                echo 
                  '<td>
                    <div class="btn-group">
                      <button class="btn btn-warning btnEditarUsuario" idUsuario="'.$value["id_usuario"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id_usuario"].'" fotoUsuario="'.$value["foto"].'"><i class="fa fa-times"></i></button>
                    </div>
                  </td>                
                </tr>';              
              }
            ?>
          </tbody>
        </table>
      </div>
      
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Ventana modal: agregar usuario -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>

        <div class="modal-body">        
          <div class="box-body">

            <!-- Nombre -->
            <div class="form-group">            
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-sm" name="nuevoNombre" placeholder="Nombre" required>
              </div>
            </div>

            <!-- Apellido Paterno -->
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-sm" name="nuevoApellidoPaterno" placeholder="Apellido paterno" required>
              </div>
            </div>

            <!-- Apellido Materno -->
            <div class="form-group">
              <div class="input-group">    
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-sm" name="nuevoApellidoMaterno" placeholder="Apellido materno" required>
              </div>
            </div>

            <!-- Usuario -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-sm" name="nuevoUsuario" placeholder="Usuario" id="nuevoUsuario" required>
              </div>
            </div>

            <!-- Password -->
            <div class="form-group">
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-sm" name="nuevoPassword" placeholder="Contraseña" required>
              </div>
            </div>

            <!-- Entrada para seleccion de perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar perfil</option>
                  <option value="1">Administrador</option>
                  <option value="2">Especial</option>
                  <option value="3">Vendedor</option>
                </select>
              </div>
            </div>

            <!-- Entrada para seleccion foto -->
            <div class="form-group">
              <input type="file" class="nuevaFoto" name="nuevaFoto">
              <p class="help-block">Peso máximo de la foto: 2 MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="60px">
            </div>

          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar usuario</button>
        </div>

        <?php

        $crearUsuario = new ControladorUsuarios();
        $crearUsuario -> ctrCrearUsuario();

        ?>
      </form>
    </div>
  </div>
</div>
<!-- Termina - Ventana modal: agregar usuario -->

<!-- Ventana modal editar usuario -->
<div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">

        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar usuario</h4>
        </div>

        <div class="modal-body">        
          <div class="box-body">

            <!-- Nombre -->
            <div class="form-group">            
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-sm" id="editarNombre" name="editarNombre" value="" required>
              </div>
            </div>

            <!-- Apellido Paterno -->
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-sm" id="editarApellidoPaterno" name="editarApellidoPaterno" value="" required>
              </div>
            </div>

            <!-- Apellido Materno -->
            <div class="form-group">
              <div class="input-group">    
                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                  <input type="text" class="form-control input-sm" id="editarApellidoMaterno" name="editarApellidoMaterno" values="" required>
              </div>
            </div>

            <!-- Usuario -->
            <div class="form-group">
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-sm" id="editarUsuario" name="editarUsuario" value="" readonly>
              </div>
            </div>

            <!-- Password -->
            <div class="form-group">
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-sm" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>
            </div>

            <!-- Entrada para seleccion de perfil -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select class="form-control input-lg" name="editarPerfil">
                  <option value="" id="editarPerfil"></option>
                  <option value="1">Administrador</option>
                  <option value="2">Especial</option>
                  <option value="3">Vendedor</option>
                </select>
              </div>
            </div>

            <!-- Entrada para seleccion foto -->
            <div class="form-group">
              <input type="file" class="nuevaFoto" name="editarFoto">
              <p class="help-block">Peso máximo de la foto: 2 MB</p>
              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="60px">
              <input type="hidden" name="fotoActual" id="fotoActual">
            </div>

          </div>
        </div>
        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar usuario</button>
        </div>

        <?php

        $editarUsuario = new ControladorUsuarios();
        $editarUsuario -> ctrEditarUsuario();

        ?>
      </form>
    </div>
  </div>
</div>
<!-- Termina-Ventana modal editar usuario -->

<!-- Borrado Logico de Usuarios -->
<?php

$borrarUsuario = new ControladorUsuarios();
$borrarUsuario -> ctrBorrarUsuario();

?>