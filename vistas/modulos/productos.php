<div class="content-wrapper">
  <section class="content-header">    
    <h1>      
      Administrar productos    
    </h1>

    <ol class="breadcrumb">      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>      
      <li class="active">Administrar productos</li>    
    </ol>
  </section>

  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">          
          Agregar producto
        </button>
      </div>
      <div class="box-body">        
        <table class="table table-bordered table-striped dt-responsive tablas">
          
        <thead>         
          <tr>           
            <th style="width:10px">#</th>
            <th>Imagen</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Precio de compra</th>
            <th>Precio de venta</th>
            <th>Alta</th>
            <th>Modificación</th>
            <th>Acciones</th>
          </tr> 
        </thead>

        <tbody>
          <tr>
            <td>1</td>
            <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></img></td>
            <td id="IdProducto">Codigo</td>
            <td>Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
            <td id="IdCatergoria">Categoria: Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
            <td>20</td>
            <td>$20.00</td>
            <td>$20.00</td>
            <td>2023-01-17 12:05:02</td>
            <td>2023-01-17 12:05:02</td>
            <td>
              <div class="btn-group">                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
              </div>  
            </td>
          </tr>
          
          <tr>
            <td>1</td>
            <td><img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="40px"></img></td>
            <td id="IdProducto">Codigo</td>
            <td>Descripción: Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
            <td id="IdCatergoria">Categoria: Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
            <td>20</td>
            <td>$20.00</td>
            <td>$20.00</td>
            <td>2023-01-17 12:05:02</td>
            <td>2023-01-17 12:05:02</td>
            <td>
              <div class="btn-group">                  
                <button class="btn btn-warning" ><i class="fa fa-pencil"></i></button>
                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
              </div>  
            </td>
          </tr>
        </tbody>
        </table>

      </div>
    </div>
  </section>
</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">  

  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar producto</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->            
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 
                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar código" required>
              </div>
            </div>

            <!-- ENTRADA PARA EL DESCRIPCIÓN -->
             <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>
              </div>
            </div>

            <!-- ENTRADA PARA SELECCIONAR CATEGORIA -->
            <div class="form-group">              
              <div class="input-group">              
                <span class="input-group-addon"><i class="fa fa-list-ol"></i></span> 
                <select class="form-control input-lg" name="nuevaCategoria">
                  <option value="">Selecionar categoria</option>
                  <option value="1">Equipos eléctricos</option>
                  <option value="2">Taladros</option>
                  <option value="3">Andamios</option>
                </select>
              </div>
            </div>

            <!-- ENTRADA PARA STOCK Y PRECIO DE VENTA -->
            <div class="form-group row">
              <div class="col-xs-6">                
                <div class="form-group">              
                  <div class="input-group">              
                    <span class="input-group-addon"><i class="fa fa-hashtag"></i></span> 
                    <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required>
                  </div>
                </div>
              </div>
              <!-- ENTRADA PARA PRECIO DE COMPRA -->
              <div class="col-xs-6">
                <div class="input-group">              
                  <span class="input-group-addon"><i class="fa fa-usd"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio de Compra" required>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <!-- ENTRADA PARA PRECIO DE VENTA -->
              <div class="col-xs-6">                
                <div class="input-group">              
                  <span class="input-group-addon"><i class="fa fa-usd"></i><i class="fa fa-usd"></i></span> 
                  <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio de Venta" required>
                </div>
              </div>

              <!-- Checkbox para aplicar porcentaje en el calculo del precio de venta con base en el precio de compra. -->
              <div class="col-xs-3">
                <div class="form-group">
                  <label >
                    <input type="checkbox" class="minimal porcentaje" checked>
                    Utilizar porcentaje
                  </label>
                </div>
              </div>

              <!-- Entrada para porcentaje -->
              <div class="col-xs-3" >
                <div class="input-group">
                  <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                </div>
              </div>
            </div>

            <!-- ENTRADA PARA SUBIR IMAGEN -->
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="panel">SUBIR IMAGEN:  
                  <p class="help-block"> Peso máximo de la foto 2 MB</p>                
                </div>                
                <input type="file" id="nuevaImagen" name="nuevaImagen">              
              </div>

              <div class="col-xs-6"  style="padding: 10">
                <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px" style="float: center">
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>

      </form>
    </div>
  </div>
</div>


