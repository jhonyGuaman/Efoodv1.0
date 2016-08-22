<?php
include_once('conexion/db.php');
?>
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<link rel="stylesheet" href="dist/css/Efood.css">
<script src="ventas/control_ventas.js"></script>
<script src="Controlador/control_pedidos.js"></script>
<script src="Controlador/control_cliente.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    var idpedido = $("#idpedio_txt").val();
      $("#cedula_buscar").focus();
      $(".box-title").html("Registro de Pedido N: "+idpedido);
        Fpedido();        /*funcion para buscar en la tabla pedido*/
        detallepedido();  /*funcion para buscar en la tabla detallepedido*/
        //BnumVenta();      /*funcion para generar el numero de venta*/
        btnCancelar();    /*funcion para preguntar si se desea cancelar la accion actual*/
  });

 function buscariva2(){
  nfila=$("#tabla_detalle  tbody").find("tr").length;
   idpedido = $("#idpedio_txt").val();
   total=0;
   totaliva=0;
  for(var i=1 ; i<=nfila; i++){   
     idplato=$("#codigo"+i+"").val();
     //alert("id plato:"+idplato);
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'ventas/buscariva.php',
        data:{idplato:idplato,idpedido:idpedido},
        success:function(response){
          if(response.respuesta=='Si'){
              totaliva=totaliva+(parseFloat(response.iva)+(parseFloat(response.iva)*parseFloat(response.valor)));
              $("#iva12").val(totaliva);
              $("#P_iva").html(response.impuesto);
              $("#ruc1").val(response.ruc2);
              if(parseInt(response.numeroFa2)<10){
              $("#numFac1").val("00000000"+response.numeroFa2);
              }else if(parseInt(response.numeroFa2)<100){
              $("#numFac1").val("0000000"+response.numeroFa2);
              }else if(parseInt(response.numeroFa2)<1000){
              $("#numFac1").val("000000"+response.numeroFa2);
              }else if(parseInt(response.numeroFa2)<10000){
              $("#numFac1").val("00000"+response.numeroFa2);
              }
          }else{
              total=total+parseFloat(response.iva)
              $("#iva0").val(total);
              $("#ruc2").val(response.ruc1);
              if(parseInt(response.numeroFa1)<10){
              $("#numFac2").val("00000000"+response.numeroFa1);
              }else if(parseInt(response.numeroFa1)<100){
              $("#numFac2").val("0000000"+response.numeroFa1);
              }else if(parseInt(response.numeroFa1)<1000){
              $("#numFac2").val("000000"+response.numeroFa1);
              }else if(parseInt(response.numeroFa1)<10000){
              $("#numFac2").val("00000"+response.numeroFa1);
              }

          $("#total_p").val(total+totaliva);

          }
          $("#totalp").val(total+totaliva);
          $("#total_p").val(total+totaliva);
        }
      });
     //alert("los otros productos son platos");
  } // fin del for
}//fin de la funcion buscar



  function btnCancelar(){
    $("#btn_cancelar").click(function(){
      swal({   title: "¿Estás seguro?", 
        text: "De regresar!",  
        type: "warning", 
        showCancelButton: true,  
        confirmButtonColor: "#DD6B55", 
        confirmButtonText: "Si, Regresar!",  
        cancelButtonText: "No",   
        closeOnConfirm: false,  
        closeOnCancel: true 
      },
        function(isConfirm){ 
          if (isConfirm) {     
            swal("Se a cancelado!", "Sera redireccionado al inicio", "success");   
            cambiarcont('movimiento_mesa.php');
          }    
        });
    });
  }

/*
* @autor    Jhony Guaman & John Morrillo
* @date      1/Febrero/2016
* @name      BmunVenta() 
* La funcion BmunVenta permite buscar el numero de factura anterior 
* y crea un el siguiente numeracion para la factura 
*/
  function BnumVenta(){
    $.ajax({
      url:'ventas/buscar_numVenta.php',
      type:'POST',
      dataType:'json',
        success:function(response){
          if(response.mensaje==null){ $("#nfactura").val("0000001"); }else{
              var nfac=parseInt(response.mensaje)+1;      
                  if(parseInt(response.mensaje)<10){
                      $("#nfactura").val("000000"+nfac);  
                          }else if(parseInt(response.mensaje)>=10){
                                  $("#nfactura").val("00000"+nfac);  
                                }      
          }    
        }   
    });
  }
/*
* @autor    Jhony Guaman & John Morrillo
* @date      3/Enero/2016
* @name      Fpedido()
* La funcion Fpedido permite buscar el pedido mediante el id
*/
function Fpedido(){
var id=$("#idpedio_txt").val();
$.ajax({
    url:'Modelo/buscar_pedido.php',
    type:'POST',
    dataType:'json',
    data:{id:id},
      success:function(response){
        if(response.respuesta==true){
          $("#total_p").val(response.total);
          $("#subtotal").val(response.subtotal);
          $('#totalp').val(response.total);
        }else
            {
              new PNotify({title: 'Alerta',text: 'No se encuentran pedidos disponibles para esta mesa',type: 'error',delay: 2000});
              cambiarcont('movimiento_mesa.php');
              
            }
      }
});
}
/*
* @autor    Jhony Guaman & John Morrillo
* @date      3/Enero/2016
* @name      detallepedido 
* La funcion detallepedido permite bucar el detalle del pedido 
*/
function detallepedido(){
  var id =$("#idpedio_txt").val();
  $.ajax({
      url:'Modelo/buscar_detalleP.php',
      type:'POST',
      data:{id:id},
      success:function(response){
      $("#tproductos").html(response)   
      buscariva2(); 
      }     
  });
}


</script>

<div class="container-fluid"> <!-- Page Heading -->
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Facturación
      <div class="pull-right box-tools">
        <button class="btn btn-primary  btn-sm" id="btn_generar" onclick="guardarVenta()"><i class="fa fa-print"></i> Generar Venta</button>
        <button class="btn btn-danger  btn-sm" id="btn_cancelar" ><i class="ion-ios-undo-outline"></i> Retornar</button>
        <button class="btn btn-danger  btn-sm" id="btn_eliminar" ><i class="fa fa-trash-o"></i> Eliminar Pedido</button>
      </div><!-- /. tools -->
    </h1>
  </div>
</div><!-- /.row -->
<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Registro de Pedidos - 
</h3>
    </div><!-- /.box-header -->
    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="nFactura">
            <label for="numero">Cedula del cliente: </label>
            <div class="input-group input-group-sm">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control"  id="cedula_buscar" placeholder="Ingrese el numero de Cedula" size="10" maxlength="10"> 
              <div class="input-group-btn">
                <button type="button" class="btn btn-danger"> <i class="fa fa-search"></i></button>
                <button type="button" class="btn btn-danger" data-toggle='modal' data-target='#modalR_Clientes'> <i class="fa fa-user-plus"></i></button>
              </div><!-- /btn-group -->
            </div>
            <div id="aceptar" class="aceptado_Cliente">
            </div>
            <div id="negar" class="negar_cliente">
            </div>
          </div>
        </div>
      </div> <!--fin del panel para el cliente-->

    <div class="panel panel-default">
      <div class="panel-body">
        <div id="tproductos">
          <table class="table table-bordered table-hover" id="tabla_detalle">
            <thead>
              <tr>
                <th>#</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Precio unit.</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div> <!--fin del panel para la tabla-->
    <div class="row">
      <div class="col-md-4 ">
      </div>
      <div class="col-md-4 boton_limpirar">
<!--       <button class="btn btn-info btn-sm" id="btn_limpirar" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Limpiar Pedido</button> -->
      </div>
      <div class="col-md-4 filas">
        Numeros de Productos:<input type="text" name="nfilas" id="span_cantidad"> </input>
      </div>
    </div>
  </div> <!--fin del col-md-7-->
  <div class="col-md-5">
    <div class="total">
      <input type="text" name="total_p" id="total_p" value="$0.00">
    </div>
    <div class="panel panel-default">
      <div class="panel-body">
        <div id="nFactura" class="text-center">
          <label for="numero">Numero de Venta: </label>
          <div class="input-group nfactura" style="margin-left: auto;margin-right: auto;">
            <input type="text" class="form-control centrar_input"  id="nfactura" placeholder="0000001" disabled="false">
            <input type="text" name="numFac1" id="numFac1">
            <input type="text" name="numFac2" id="numFac2">
            <input type="text" id="ruc1">
            <input type="text" id="ruc2">

          </div>
        </div>
      </div>
    </div> <!--fin del panel para el numero de Factura-->

    <div class="panel panel-default">
      <div class="panel-body">
        <div id="subTotal">
              <div class="row">
                    <div class="col-md-4">
                      Sub-Total:
                    </div>
                    <div class="col-md-6 alinear_der">
                  <input type="text" class="form-control"  id="subtotal" placeholder="$ 0,00" >
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-4">
                      <p id="P_iva">Iva 12%:</p>
                    </div>
                    <div class="col-md-6 alinear_der">
                  <input type="text" class="form-control"  id="iva12" placeholder="$ 0,00" >
                    </div>
              </div>
              <div class="row">
                    <div class="col-md-4">
                      Iva 0%:
                    </div>
                    <div class="col-md-6 alinear_der">
                  <input type="text" class="form-control"  id="iva0" placeholder="$ 0,00" >
                    </div>
              </div>
          </div> <!-- fin del div subtotal -->
          <div id="totalP" class="ValorP">
            <div class="row">
                  <div class="col-md-4">
                    Total a Pagar:
                  </div>
                  <div class="col-md-6 alinear_dere">
                <input type="text" class="form-control"  id="totalp" placeholder="$ 0,00" >
                  </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!--fin del panel para el Total a pagar-->
  </div>
</div><!-- /.box -->
</div>


<!-- FORMULARIO PARA REGISTRAR CLIENTES-->

<div class=" modal modal-primary fade" id="modalR_Clientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h2 class="modal-title">Registro de Cliente</h2>
    </div>
    <div class="modal-body">
      <div class="alert alert-success text-center" id="exito" style="display:none;">
        <span class="glyphicon glyphicon-ok"> </span><span> Cliente Registrado Correctamente...</span>
      </div>
      <form class="form-horizontal" id="formcliente">
        <div class="form-group">
          <label for="cedula" class="control-label col-xs-5">Cedula: </label>
          <div class="col-xs-5">
          <div class="input-group">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
            </div>
            <input type="text" class="form-control" name="cedu" id="cedula" placeholder="Ingrese su Cedula" autofocus required size="10" maxlength="10" onkeyPress="return solo_numeros(event)">
          </div>
          </div>
        </div>

        <div class="form-group">
          <label for="nombre" class="control-label col-xs-5">Nombres: </label>
          <div class="col-xs-5">
          <div class="input-group ">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </div>
            <input type="text" class="form-control" id="nombre"
            placeholder="Ingrese sus Nombres"  onKeyPress="return solo_letras(event)">
          </div>
        </div>
        </div>

        <div class="form-group">
          <label for="ape_paterno" class="control-label col-xs-5">Apellido Paterno: </label>
          <div class="col-xs-5">
          <div class="input-group">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </div>
            <input type="text" class="form-control" id="ape_paterno"
            placeholder="Ingrese el Apellido Paterno"  onKeyPress="return solo_letras(event)">
          </div>
        </div>
        </div>

        <div class="form-group">
          <label for="ape_materno" class="control-label col-xs-5">Apellido Materno: </label>
          <div class="col-xs-5">
          <div class="input-group">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            </div>
            <input type="text" class="form-control" id="ape_materno"
            placeholder="Ingrese el Apellido Materno"  onKeyPress="return solo_letras(event)">
          </div>
        </div>
        </div>

        <div class="form-group">
          <label for="direccion" class="control-label col-xs-5">Dirección: </label>
          <div class="col-xs-5">
          <div class="input-group">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
            </div>
            <textarea rows="3" class="form-control" id="direccion"
            placeholder="Ingrese la Dirección "> </textarea>
          </div>
        </div>
        </div>
        <div class="form-group">
          <label class="control-label col-xs-5">Telefono:</label>
          <div class="col-xs-5">
          <div class="input-group">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
            </div>
            <input type="text" class="form-control" id="telefono" data-inputmask='"mask":"(999) 999-9999"' data-mask>
          </div>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      <button type="button" class="btn btn-success" id="gcliente" >Guardar</button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--FIN DEL FORMULARIO PARA MODIFICAR PLATOS-->


