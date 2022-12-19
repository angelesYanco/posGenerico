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

  <!-- Main content 
  Tabla con los datos de los usuarios
  -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
        Agregar usuario
      </button>

      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas">
          <thead>
            <tr>
              <th style="width:5px">#</th>
              <th style="width:220px">Nombre completo</th>
              <th style="width:60px">Usuario</th>
              <th style="width:50px">Foto</th>
              <th style="width:60px">Perfil</th>
              <th style="width:50px">Estado</th>
              <th style="width:100px">Ultimo login</th>
              <th style="width:180px">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Usuario Administrador</td>
              <td>admin</td>
              <td><img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width=""></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2017-12-11 12:05:32</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      
    </div>
    <!-- /.box -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!--
  Ventana modal para agregar usuario
-->
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
                <input type="text" class="form-control input-sm" name="nuevoUsuario" placeholder="Usuario" required>
              </div>
            </div>
            <!-- Password -->
            <div class="form-group">
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-sm" name="nuevoPassword" placeholder="Contraseña" required>
              </div>
            </div>

            <!-- 
              Entrada para seleccion de perfil 
            -->
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
            <!-- 
              Entrada para seleccion de perfil 
            -->
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

