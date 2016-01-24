
<link rel="stylesheet" href="dist/css/AdminLTE.css">
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script>
$(document).ready(function(){
$("#Bus_idpedido").focus();

$("#Bus_idpedido").keypress(function(tecla) {
  if(tecla.which == 13){
    if($("#Bus_idpedido").val()==""){
      //alert("Id Pedido esta vacio");
      new PNotify({title: 'Error',text: 'Por favor debe ingresar un codigo de pedido',type: 'error',delay: 2000});
        $("#Bus_idpedido").focus();

    }else{  
            $("#idpedio_txt").val($("#Bus_idpedido").val());    
            cambiarcont('cancelar_pedido.php');
    }
  }
});
$("#btn_idpedido").click(function(){
  if($("#Bus_idpedido").val()==""){
    new PNotify({title: 'Error',text: 'Por favor debe ingresar un codigo de pedido',type: 'error',delay: 2000});
    $("#Bus_idpedido").focus();

  }else{
            $("#idpedio_txt").val($("#Bus_idpedido").val());
            cambiarcont('cancelar_pedido.php');
    }
});
});


</script>

<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">
          <div class="col-lg-8">
          <i class="fa fa-opencart"></i>
          Movimientos de Mesas

          </div>
          <div class="col-lg-4">
            <div class="input-group input-group-sm">
            <input type="text" class="form-control" id="Bus_idpedido"placeholder="Ingrese el Codigo del Pedido" onkeypress="return solo_numeros(event)">
            <span class="input-group-btn">
            <button class="btn btn-success btn-flat" type="button" id="btn_idpedido" >Facturar Pedido</button>
            </span>
          </div><!-- /input-group -->
          </div>
          <small>Control de Mesas</small>

        </h1>

        <ol class="breadcrumb">
          <li class="active">
            <i class="fa fa-opencart"></i> Control M.
          </li>
        </ol>
      </div>
    </div> <!--fin del row 1 -->
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa1">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div id="totalmesa1" class="huge">0,00</div>
                <div>Mesa 1</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa1">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div  class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa2">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa2">0,00</div>
                <div>Mesa 2</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa2">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa3">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa3">0,00</div>
                <div>mesa 3</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa3">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa4">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa4">0,00</div>
                <div>Mesa 4</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa4">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->
    </div> <!-- /.row -->

    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa5">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa5">0,00</div>
                <div>Mesa 5</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa5">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa6">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa6">0,00</div>
                <div>Mesa 6</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa6">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa7">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa7">0,00</div>
                <div>Mesa 7</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa7">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa8">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa8">0,00</div>
                <div>Mesa 8</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa8">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->
    </div> <!-- fin del row -->

    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa9">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa9">0,00</div>
                <div>Mesa 9</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left " id="estadomesa9">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa10">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa10">0,00</div>
                <div>Mesa 10</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa10">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa11">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa11">0,00</div>
                <div>Mesa 11</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa11">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa12">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa12">0,00</div>
                <div>Mesa 12</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa12">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->
    </div> <!-- fin del row -->

    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa13">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa13">0,00</div>
                <div>Mesa 13</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa13">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa14">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa14">0,00</div>
                <div>Mesa 14</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa14">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa15">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa15">0,00</div>
                <div>Mesa 15</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa15">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa16">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa16">0,00</div>
                <div>Mesa 16</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa16">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->
    </div> <!-- fin del row -->

    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa17">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa17">0,00</div>
                <div>Mesa 17</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa17">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa18">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa18">0,00</div>
                <div>Mesa 18</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa18">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div> <!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa19">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa19">0,00</div>
                <div>Mesa 19</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa19">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->

      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green" id="mesa20">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge" id="totalmesa20">0,00</div>
                <div>Mesa 20</div>
              </div>
            </div>
          </div>
          <a href="#">
            <div class="panel-footer">
              <span class="pull-left" id="estadomesa20">Libre</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div><!--Fin de col-lg-3  -->
    </div> <!-- fin del row -->
    <!-- /.row -->

  </div><!-- /.container-fluid -->
</div> <!--fin de page-wrapper -->
