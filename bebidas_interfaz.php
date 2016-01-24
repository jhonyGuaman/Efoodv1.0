
<?php
include_once('conexion/db.php');
 ?>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="Controlador/control_bebidas.js"></script>


<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-industry"></i>
        Registro de bebidas
      </h1>
    </div>
  </div>
  <!-- /.row -->
</div>

<div class="panel panel-danger ">  <!--PANEL PRIMARIO -->
  <div class="panel-heading">
    <div class="panel-title"><h3>Ingresar Nueva bebida</h3>
    </div>
  </div>
  <div class="panel-body">                         <!-- PANEL SECUNDARIO -->
        <div class="col-md-4">
            <label for="cedula">Nombre del Producto: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="nombreP" placeholder="Ingrese Nombre del Producto">
            </div>
          </div>
        <div class="col-md-4">
            <label for="precio">Precio: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="precio" placeholder="Ingrese el Precio" onKeyPress="return solo_monedas(event)">
            </div>
          </div>
        <div class="col-md-4">
            <label for="cantidad">Cantidad : </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-stats"></span>
              </div>
              <input type="text" class="form-control" id="cantidad" placeholder="Ingrese la Cantidad en Stock" onkeypress="return solo_numeros(event)" size="10" maxlength="3">
            </div>
        </div>
<div class="col-md-4">
            <label for="tipo_plato">Categoria: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
              </div>
              <select class="form-control" id="idtipo">
                <option value="">Seleccione</option>
                <?php
                $consulta =pg_query($conexion,("Select * from tipoplato"));

                while($tipo=pg_fetch_array($consulta)){
                 ?>
                <option value="<?php echo $tipo[0]; ?>"><?php  echo $tipo[1] ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
           <div class="col-md-4">
            <label for="tipo_plato">Dias disponibles: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
              </div>
              <select class="form-control" id="dias">
                <option value="">Seleccione</option>
                <option value="L-V">Lunes - Viernes</option>
                <option value="S-D">Sábado - Domingo</option>
                <option value="D">Domingos</option>
                <option value="F">Feriados</option>
                <option value="D-F">Domingos - Feriados</option>
                <option value="L-D">Lunes - Domingos</option>
                </select>
            </div>
    </div>    
</div>  <!--FIN DEL PANEL SECUNDARIO -->
</div>            <!-- FIN DEL PANEL PRIMARIO -->
<div class="row">
<div class="col-md-6">
<button type="button" class="btn btn-danger" id="btn_producto"> Guardar <i class="fa fa-floppy-o "></i></button>
</div>
</div>