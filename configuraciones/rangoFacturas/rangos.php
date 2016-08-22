<!-- LIBRERIAS JS -->
<script src="Controlador/control_rangos.js"></script>
<!-- Ion Slider -->
<script src="plugins/ion.rangeSlider-2.1.4/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
<style type="text/css">
  .box-header{
      padding: 20px;
    }
</style>
<div class="container-fluid">
  <div clas="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>
        Configuración Rangos de número de Facturas.
      </h1>
    </div>
  </div> <!-- /.row -->
  <div class="row">
   <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal" id="new_rango"><i class="fa fa-plus"></i> Nuevo Rango
                </button>
                <div class="btn-group">
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="lista_rangos">
                <?php include('consultar_rangos.php'); ?>
              </div>
              
            </div>         
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Nuevo Rango   </h4>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" id="formRangos">
              
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Ruc :</label>
                <div class="col-xs-5">
                  <input id="ruc" name="ruc" type="text" class="form-control" placeholder="Ingrese ruc">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Rangos :</label>
                <div class="col-xs-5">
                  <input type="text" id="rangos" name="rangos" value="" />
                </div>
              </div>
            <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Desde :</label>
                <div class="col-xs-5">
                  <input id="desde" name="desde" type="text" class="form-control" placeholder="Ingrese nombre del valor">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Hasta :</label>
                  <div class="col-xs-5">
                    <input id="hasta" name="hasta" type="text" class="form-control" placeholder="valor hasta">              
                  </div>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cancelar">Cerrar</button>
        <button type="button" class="btn btn-success" id='btn_rangos'">Guardar Rango</button>
      </div>
    </div>
  </div>
</div>   

<!-- Modal  para actualizar y calcular el rango-->
<div class="modal fade" id="Modal_actualizarRango" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Rango</h4>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" id="formRangos">
              <div class="form-group">
                <label for="isbn" class="control-label col-xs-5">ID :</label>
                <div class="col-xs-5">
                  <input  type="hidden" id="idrango" name="idrango"/>
                  <input id="idrangos" name="idrangos" type="text" class="form-control" placeholder="Ingrese Codigo" disabled="false">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Ruc :</label>
                <div class="col-xs-5">
                  <input id="rucA" name="rucA" type="text" class="form-control" placeholder="Ingrese ruc">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Rangos :</label>
                <div class="col-xs-5">
                  <input type="text" id="rangosA" name="rangosA" value="" />
                </div>
              </div>
            <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Desde :</label>
                <div class="col-xs-5">
                  <input id="desdeA" name="desdeA" type="text" class="form-control" disabled="false">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Hasta :</label>
                  <div class="col-xs-5">
                    <input id="hastaA" name="hastaA" type="text" class="form-control" placeholder="valor hasta">              
                  </div>
              </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success"  onclick='update_rango()'">Actualizar Rango</button>
      </div>
    </div>
  </div>
</div> 

<!-- Modal  para dar de baja un # factura-->
<div class="modal fade" id="Modal_eliminar_Factura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Dar de baja numero factura</h4>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" id="formRangos">
              <div class="form-group">
                <label for="isbn" class="control-label col-xs-5">ID :</label>
                <div class="col-xs-5">
                  <input id="idrangosE" name="idrangosE" type="text" class="form-control" placeholder="Ingrese Codigo" disabled="false">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Ruc :</label>
                <div class="col-xs-5">
                  <input id="rucE" name="rucE" type="text" class="form-control" placeholder="Ingrese ruc" disabled="false">
                </div>
              </div>
            <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Numero de Factura a Elmininar:</label>
                <div class="col-xs-5">
                  <input id="desdeE" name="desdeE" type="text" class="form-control">
                </div>
              </div>
              
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger"  onclick='dar_Baja()'">Dar de Baja este Numero</button>
      </div>
    </div>
  </div>
</div>            

<script>
$(document).ready(function(){
var $range = $("#rangos");
$range.ionRangeSlider({
    type: "double",
    min: 1,
    max: 5000,
    from: 1,
    to: 100,
    step: 5,
    grid: true,
    keyboard: true,
    keyboard_step: 1,
    onStart: function (data) {
         $('#desde').val("00000000"+data.from);
        $('#hasta').val("000000"+data.to);
    },
});

var $range2 = $("#rangosA");
$range2.ionRangeSlider({
    type: "double",
    min: 1,
    max: 5000,
    from: 1,
    to: 100,
    step: 5,
    grid: true,
    keyboard: true,
    keyboard_step: 1,
    disable: true
});

$range.on("change", function () {
    var $this = $(this),
        from = $this.data("from"),
        to = $this.data("to");

      if(from<=9){
        $('#desde').val("00000000"+from);
      }else if(from <=99){
        $('#desde').val("0000000"+from);
      }else if(from <=999){
        $('#desde').val("000000"+from);
      }else if(from <=9999){
        $('#desde').val("00000"+from);
      }else if(from <=99999){
        $('#desde').val("0000"+from);
      }

       if(to<=9){
        $('#hasta').val("00000000"+to);
      }else if(to <=99){
        $('#hasta').val("0000000"+to);
      }else if(to <=999){
        $('#hasta').val("000000"+to);
      }else if(to <=9999){
        $('#hasta').val("00000"+to);
      }else if(to <=99999){
        $('#hasta').val("0000"+to);
      }
});


$('#hasta').blur(function(){
  var $range = $("#rangos");
  var desde = parseInt($('#desde').val());
  var hasta = parseInt($('#hasta').val());
  slider = $range.data("ionRangeSlider");
    slider && slider.update({
      from: desde,
      to: hasta
    });
  
  });
$('#hastaA').blur(function(){
  var $rangeA = $("#rangosA");
  var desde = parseInt($('#desdeA').val());
  var hasta = parseInt($('#hastaA').val());
  slider = $rangeA.data("ionRangeSlider");
    slider && slider.update({
      from: desde,
      to: hasta
    });
  
  });
});

var $rangeA = $("#rangosA");
$rangeA.on("change", function () {
    var $this = $(this),
        from = $this.data("from"),
        to = $this.data("to");

      if(from<=9){
        $('#desdeA').val("00000000"+from);
      }else if(from <=99){
        $('#desdeA').val("0000000"+from);
      }else if(from <=999){
        $('#desdeA').val("000000"+from);
      }else if(from <=9999){
        $('#desdeA').val("00000"+from);
      }else if(from <=99999){
        $('#desdeA').val("0000"+from);
      }

       if(to<=9){
        $('#hastaA').val("00000000"+to);
      }else if(to <=99){
        $('#hastaA').val("0000000"+to);
      }else if(to <=999){
        $('#hastaA').val("000000"+to);
      }else if(to <=9999){
        $('#hastaA').val("00000"+to);
      }else if(to <=99999){
        $('#hastaA').val("0000"+to);
      }
});


</script>