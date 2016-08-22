<!-- LIBRERIAS JS -->
<script src="Controlador/control_impuesto.js"></script>

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
        Configuración del Iva.
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
                <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#myModal" id="new_imp"><i class="fa fa-plus"></i> Nuevo impuesto
                </button>
                <div class="btn-group">
                  
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="lista_impuestos">
                <?php include('Consultar_impuestos.php'); ?>
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
        <h4 class="modal-title" id="myModalLabel">Nuevo Impuesto  </h4>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" id="formImpuesto">
              
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Impuesto :</label>
                <div class="col-xs-5">
                  <input id="impuesto1" name="impuesto" type="text" class="form-control" placeholder="Ingrese nombre del impuesto">
                </div>
              </div>
            <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Valor :</label>
                <div class="col-xs-5">
                  <input id="valor1" name="valor" type="text" class="form-control" placeholder="Ingrese nombre del valor">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Estado :</label>
                <div class="col-xs-5">
                  
               <label>
                  <input type="checkbox" id="chk_estado">
                </label>
              </div>
            </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cancelar">Cerrar</button>
        <button type="button" class="btn btn-success" id='btn_iva'">Guardar impuesto</button>
      </div>
    </div>
  </div>
</div>   

<!-- Modal -->
<div class="modal fade" id="modalimpuesto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Actualizar Impuesto  </h4>
      </div>
      <div class="modal-body">
           <form class="form-horizontal" id="formUsuario">
              <div class="form-group">
                <label for="isbn" class="control-label col-xs-5">ID :</label>
                <div class="col-xs-5">
                  <input  type="hidden" id="idimpuesto" name="idimpuesto"/>
                  <input id="idimpuestos" name="idimpuestos" type="text" class="form-control" placeholder="Ingrese Codigo" disabled="false">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Impuesto :</label>
                <div class="col-xs-5">
                  <input id="impuesto" name="impuesto" type="text" class="form-control" placeholder="Ingrese nombre del impuesto">
                </div>
              </div>
            <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Valor :</label>
                <div class="col-xs-5">
                  <input id="valor" name="valor" type="text" class="form-control" placeholder="Ingrese nombre del valor">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Estado :</label>
                <div class="col-xs-5">
                  
               <label>
                  <input type="checkbox" id="chk_estado">
                </label>
              </div>
            </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success"  onclick='update_impuesto()'">Actualizar impuesto</button>
      </div>
    </div>
  </div>
</div>            

<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-red',
    radioClass: 'iradio_square-red',
  });

});

$("#new_imp").click(function(){
  $('input').iCheck('uncheck'); 
});
</script>