<?php
include_once('conexion/db.php');
 ?>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="Controlador/control_platos.js"></script>
<script src="Controlador/Pnotify.js"></script>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-md-8">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>
        Platos
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Platos
        </li>
      </ol>
    </div>
  </div>
  <!-- /.row -->
</div> <!-- Fin del container-fluid-->

<div class="panel panel-danger ">  <!--PANEL PRIMARIO -->
  <div class="panel-heading">
    <div class="panel-title"><h3>Ingresar Nuevos Platos</h3></div>
  </div>

  <div class="panel-body">                         <!-- PANEL SECUNDARIO -->
    <div class="col-md-4">
            <label for="cedula">Nombre Plato: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="nombre_plato" placeholder="Ingrese nombre del plato"  onKeyPress="return solo_letras(event)" required>
            </div>
      </div>

    <div class="col-md-4">
            <label for="nombre">Precio: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="precio" placeholder="Ingrese el precio" onKeyPress="return solo_monedas(event)" required>
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
            <label for="tipo_plato">Tipo Cantidad: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
              </div>
              <select class="form-control" id="idxcantidad">
                <option value="">Seleccione</option>
                <?php
                $consulta =pg_query($conexion,("Select * from tipocantidad"));
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
                </select>
            </div>
    </div>
    
</div>  <!--FIN DEL PANEL SECUNDARIO -->
</div>            <!-- FIN DEL PANEL PRIMARIO -->
<button type="button" id="btnplato" class="btn btn-danger"> Guardar <i class="fa fa-floppy-o "></i></button>
