<style>
.boton{
  height:30px;
  width:90px;
}
</style>

<!-- LIBRERIAS JS -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="Controlador/control_mesas.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- FIN DE LIBRERIAS -->

<div class="container-fluid">
  <div clas="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>
        Registrar Mesas
      </h1>
      <div class="row">
        <div class="col-lg-12">
          <div id="mensaje" class="alert alert- alert-success desvanecer ">
            <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
              <i class="fa fa-info-circle"></i>  <strong>Mesa Registrada Correctamente</strong>
          </div>
            <div id="error" class="alert alert-danger desvanecer">
              <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-exclamation-triangle"></i>  <strong>Error al Registrar Mesa</strong>
            </div>
            <div id="vacio" class="alert alert-warning desvanecer">
              <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-exclamation-triangle"></i>  <strong>Campo mesa vacio </strong>
            </div>
        </div> <!--Fin del col-lg-12-->
      </div> <!--fin del row -->
    </div>
  </div> <!-- /.row -->
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8" >

      <div class="panel panel-danger ">  <!--PANEL PRIMARIO -->
        <div class="panel-heading">
          <div class="panel-title"> <h3>Nueva Mesa </h3> <div class="col-md-11"> </div><div id="respuesta">
            <!--<img src="dist/img/load.gif">-->
          </div>

        </div>
      </div>
      <div class="panel-body">                         <!-- PANEL SECUNDARIO -->
        <table class="table">
          <thead>
            <tr>
              <th>
                <label for="cedula">Numero de Mesa: </label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                  </div>
                  <input type="text" class="form-control" id="mesa" placeholder="Ingrese en nombre de la mesa 'mesa1' " autofocus required>
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


      <button type="button" id="btn_mesa" class="btn btn-danger"> Guardar <i class="fa fa-floppy-o "></i></button>
    </div>
    <!--</form> FIN DEL FORMULARIO -->

  </div>
    <div class="col-md-2"></div>
  
</div>
</div>
