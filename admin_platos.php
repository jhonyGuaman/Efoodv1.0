<!-- LIBRERIAS JS -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="Controlador/control_platos.js"></script>
<!--FIN DE LIBRERIAS -->

<style>
.boton{
  display: block;
  height:30px;
  width:90px;
}
</style>


<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>
        Administracion de Platos
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Administracion de Platos
        </li>
      </ol>
    </div>
  </div>
  <!-- /.row -->

  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Buscar Plato</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="col-xs-4  text-right">
        <label for="buscar" class="control-label">Buscar:</label>
      </div>
      <div class="col-xs-4">
        <div class="input-group input-group-sm ">
          <input type="text"name="buscar" id="buscar" class="form-control" onkeyup="lista_platos(this.value);" placeholder="Ingrese Nombre o Categoria">
          <div class="input-group-btn">
            <button type="button" class="btn btn-danger" data-toggle='modal' data-target='#modallibros'> <i class="fa fa-search"></i></button>
          </div><!-- /btn-group -->
        </div><!-- /input-group -->
      </div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

  <div id="lista_platos">
    <?php
    include('platos/adminPlatos/consulta_platos.php');
    ?>
  </div>

  <!-- FORMULARIO PARA MODIFICAR PLATOS -->

  <div class="modal fade" id="modalplatos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h2 class="modal-title">Datos del Plato</h2>
        </div>
        <div class="modal-body">
          <div class="alert alert-success text-center" id="exito" style="display:none;">
            <span class="glyphicon glyphicon-ok"> </span><span> Datos del Plato actualizado</span>
          </div>
          <form class="form-horizontal" id="formplatos">
            <div class="form-group">
              <label for="isbn" class="control-label col-xs-5">ID :</label>
              <div class="col-xs-5">
                <input  type="hidden" id="idplato" name="idplato"/>
                <input id="idplatos" name="idplatos" type="text" class="form-control" placeholder="Ingrese ISBN" disabled="false">
              </div>
            </div>
            <div class="form-group">
              <label for="titulo" class="control-label col-xs-5">Nombre del Plato :</label>
              <div class="col-xs-5">
                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese su Nombre">
              </div>
            </div>
            <div class="form-group">
              <label for="autor" class="control-label col-xs-5">Precio :</label>
              <div class="col-xs-5">
                <input id="precio" name="precio"  type="text" class="form-control" placeholder="Ingrese Apellido Paterno">
              </div>
            </div>
            <div class="form-group">
              <label for="añop" class="control-label col-xs-5">Tipo Plato:</label>
              <div class="col-xs-5">
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
            <div class="form-group">
              <label for="nrop" class="control-label col-xs-5">Tipo Cantidad:</label>
              <div class="col-xs-5">
                <!--<input id="cedula" name="cedula" type="text" class="form-control" placeholder="Ingrese la Cedula">-->
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
              <div class="form-group">
            <label for="tipo_plato" class="control-label col-xs-5">Dias disponibles: </label>
            <div class="col-xs-5">
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
    </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="update_platos();">Actualizar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--FIN DEL FORMULARIO PARA MODIFICAR PLATOS-->
