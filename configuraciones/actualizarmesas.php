<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>Listados de Mesas
      </h1>
      <div class="row">
        <div class="col-lg-12">
          <div id="mensaje" class="alert alert- alert-success desvanecer ">
            <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-info-circle"></i>  <strong>Categoria registrada Correctamente</strong>
          </div>
          <div id="error" class="alert alert-danger desvanecer">
            <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-exclamation-triangle"></i>  <strong>Error al Registrar Categoria</strong>
          </div>

          <div id="vacio" class="alert alert-warning desvanecer">
            <button type="button" class="close"  data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-exclamation-triangle"></i>  <strong>Campo categoria vacio </strong>
          </div>
        </div>
      </div>
    </div>
  </div> <!--fin de row -->
  
<div class="row">
    <div class="col-lg-12">
      <div id="listaMesas">
        <?php
        include('../mesas/consulta_mesas.php');
        ?>
      </div>
    </div>
  </div> <!--fin de row -->

  <!-- FORMULARIO PARA MODIFICAR EMPLEADO -->

  <div class="modal fade" id="modalmesas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h2 class="modal-title">Datos de las mesas</h2>
        </div>
        <div class="modal-body">
          <div class="alert alert-success text-center" id="exito" style="display:none;">
            <span class="glyphicon glyphicon-ok"> </span><span> Su cuenta ha sido registrada</span>
          </div>
          <form class="form-horizontal" id="formMesas">
            <div class="form-group">
              <label for="isbn" class="control-label col-xs-5">CODIGO :</label>
              <div class="col-xs-5">
                <input  type="hidden" id="idMe" name="idMe"/>
                <input id="idMesa" name="idMesa" type="text" class="form-control" placeholder="Ingrese Codigo " disabled="false">
              </div>
            </div>
            <div class="form-group">
              <label for="titulo" class="control-label col-xs-5">NUMERO DE MESA :</label>
              <div class="col-xs-5">
                <input id="num_mesa" name="num_mesa" type="text" class="form-control" placeholder="Ingrese el Tipo Plato">
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-success" onclick="update_mesas();">Guardar</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--FIN DEL FORMULARIO PARA MODIFICAR EMPLEADO -->
</div>

<script>
$(function () {
  $("#tablaMesa").DataTable();
});
</script>
