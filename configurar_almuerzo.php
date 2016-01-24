<?php
include_once('conexion/db.php');
?>
<!-- FUNCIONES JS -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="platos/control_platos.js"></script>
<!--FUNCIONES JS FIN -->
<style>
.S_fecha input{
  border: 0;
  font-size: 13px;
  text-align: center;
}
</style>
<script>
$(document).ready(function () {
  var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; //hoy es 0!
var yyyy = hoy.getFullYear();

if(dd<10) {
    dd='0'+dd
}

if(mm<10) {
    mm='0'+mm
}

hoy = mm+'/'+dd+'/'+yyyy;
//alert(hoy);
$("#fechaA").val(hoy);
});

$(document).ready(function(){
    var fecha = $("#fechaA").val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'platos/segurar_config3.php',
      data:{fecha:fecha},
      success:function(response){
        if(response.respuesta==true){
          $("#gconfig").attr("disabled",true);

          new PNotify({title: 'Warning',text: 'El menu del dia ya ha sido configurado hoy',type: 'Warning',delay: 2000});
          //$("#page-wrapper").load("configurar_plato.php");
          configurar();
        }else{

        $("#gconfig").attr("disabled",false);

        }
      }
    });
});// find

function configurar(){
  $("#confimar").modal("show");
}
</script>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>
        Configurar Almuerzos del Dia
        <div class="pull-right S_fecha">
        <input type="text" id="fechaA" value="">
        </div>
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-dashboard"></i> Selección del Amuerzo del Día

        </li>
      </ol>
    </div>
  </div>
  <!-- /.row -->
  <div class="col-xs-4"></div>
  <div class="col-md-4">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">ALMUERZOS DEL DÍA</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool"><i class="fa fa-cog"></i></button>
        </div><!-- /.box-tools -->
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-4">CALDO 1:</div>
          <div class="col-md-7">
            <div class="form-group">
              <div id="caldo1">
                <select class="form-control" id="cmb_caldo1">
                  <option value="">Seleccione</option>
                  <?php
                  $consulta =pg_query($conexion,("Select * from platos where idtipo=1"));
                  while($tipo=pg_fetch_array($consulta)){
                    ?>
                    <option value="<?php echo $tipo[0]; ?>"><?php  echo $tipo[1] ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">CALDO 2:</div>
            <div class="col-md-7">
              <div class="form-group">
                <div id="caldo2">
                  <select class="form-control" id="cmb_caldo2">
                    <option value="">Seleccione</option>
                    <?php
                    $consulta =pg_query($conexion,("Select * from platos where idtipo=1 and platos.id <>$valor"));
                    while($tipo=pg_fetch_array($consulta)){
                      ?>
                      <option value="<?php echo $tipo[0];?>" ><?php  echo $tipo[1] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">SECO 1:</div>
              <div class="col-md-7">
                <div class="form-group">
                  <select class="form-control" id="cmb_seco1">
                    <option value="">Seleccione</option>
                    <?php
                    $consulta =pg_query($conexion,("Select * from platos where idtipo=2"));
                    while($tipo=pg_fetch_array($consulta)){
                      ?>
                      <option value="<?php echo $tipo[0]; ?>"><?php  echo $tipo[1] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4">SECO 2:</div>
                <div class="col-md-7">
                  <div class="form-group">
                    <div id="seco2">
                      <select class="form-control" id="cmb_seco2">
                        <option value="">Seleccione</option>
                        <?php
                        $consulta =pg_query($conexion,("Select * from platos where idtipo=2 and platos.id <>$valor"));
                        while($tipo=pg_fetch_array($consulta)){
                          ?>
                          <option value="<?php echo $tipo[0]; ?>"><?php  echo $tipo[1] ?></option>
                          <?php } ?>
                        </select>
                      </div>

                    </div>
                  </div>
                </div>
                <button type="button" id="gconfig" class="btn btn-danger  btn-lg btn-block" data-toggle='modal' data-target='#preguntar'>Guardar </button>
              </div>

            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->

      <div class="col-xs-4"></div>


      <div class=" modal modal-success fade" id="preguntar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <!--<h2 class="modal-title">Registro de Cliente</h2>-->
            </div>
            <div class="modal-body">
              <div class="alert alert-success text-center" id="exito" style="display:none;">
                <span class="glyphicon glyphicon-ok"> </span><span> Cliente Registrado Correctamente...</span>
              </div>
              <h2>Esta seguro guardar estos almuerzos para vender hoy </h2>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" id="btn_sig" data-dismiss="modal" >Avanzar</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!--FIN DEL FORMULARIO PARA MODIFICAR PLATOS-->

      <div class="modal fade" id="confirmar" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->      <!--FIN DEL CONFIRMAR CONTRASEÑA-->
