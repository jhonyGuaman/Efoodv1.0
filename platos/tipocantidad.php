<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>

<style>
.boton{
  height:30px;
  width:90px;
}
</style>
<div class="container-fluid">

<!-- Page Heading -->
<div clas="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      <i class="fa fa-user"></i>
      Registrar Unidad de Control
    </h1>

    <div class="row">

      <div class="col-lg-12">
        <div id="mensaje" class="alert alert- alert-success desvanecer ">
          <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa fa-info-circle"></i>  <strong>Tipo Cantidad registrada Correctamente</strong>
        </div>
        <div id="error" class="alert alert-danger desvanecer">
          <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa fa-exclamation-triangle"></i>  <strong>Error al Registrar Tipo Cantidad</strong>
        </div>

        <div id="vacio" class="alert alert-warning desvanecer">
          <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa fa-exclamation-triangle"></i>  <strong>Campo Tipo vacio </strong>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.row -->
<div class="row">
  <div class="col-md-10" >

    <div class="panel panel-danger ">  <!--PANEL PRIMARIO -->
      <div class="panel-heading">
        <div class="panel-title"> <h3>Nueva unidad de control </h3> <div class="col-md-11"> </div><div id="respuesta">
            <!--<img src="dist/img/load.gif">-->
        </div>

        </div>
      </div>
      <div class="panel-body">                         <!-- PANEL SECUNDARIO -->
        <table class="table">
          <thead>
            <tr>
              <th>
                <label for="cedula">Unidad de control: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                  </div>
                  <input type="text" class="form-control" id="tipo" placeholder="Ingrese tipo Cantidad" autofocus required>
                </div>
              </th>
            </tr>
          </thead>
        </table>

      </div>  <!--FIN DEL PANEL SECUNDARIO -->
    </div>            <!-- FIN DEL PANEL PRIMARIO -->
    <div class="col-md-10">

    </div>
    <div class="col-md-2">
    <button type="button" id="btn_tipo"class="btn btn-danger"> Guardar <i class="fa fa-floppy-o "></i></button>
    </div>
    <!--</form> FIN DEL FORMULARIO -->
  </div>
</div>
<br>
<div class="row">
<div class="col-lg-10">
    <div id="lista1">
      <?php
      include('consulta_tipocant.php');
      ?>
    </div>
  </div>
</div>
<!-- FORMULARIO PARA MODIFICAR EMPLEADO -->

<div class="modal fade" id="modalplato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title">Datos del Tipo Cantidad</h2>
      </div>
      <div class="modal-body">
        <div class="alert alert-success text-center" id="exito" style="display:none;">
          <span class="glyphicon glyphicon-ok"> </span><span> El Tipo Cantidad se a Actualizado</span>
        </div>
        <form class="form-horizontal" id="formLibro">
          <div class="form-group">
            <label for="isbn" class="control-label col-xs-5">CODIGO :</label>
            <div class="col-xs-5">
              <input  type="hidden" id="idlib" name="idlib"/>
              <input id="id_update" name="id_update" type="text" class="form-control" placeholder="Ingrese Codigo " disabled="false">
            </div>
          </div>
          <div class="form-group">
            <label for="titulo" class="control-label col-xs-5">TIPO CANTIDAD :</label>
            <div class="col-xs-5">
              <input id="categoria_update" name="categoria_update" type="text" class="form-control" placeholder="Ingrese el Tipo Plato">
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="guardar_update_tipoCantidad();">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--FIN DEL FORMULARIO PARA MODIFICAR EMPLEADO -->
</div>
