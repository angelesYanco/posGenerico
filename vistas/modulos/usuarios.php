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
  Cuadricula con los datos de los usuarios
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
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Ultimo login</th>
              <th>Acciones</th>
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
<!--==================================== 
Ventana modal para agregar usuario
=====================================-->
<!-- Modal -->
<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
