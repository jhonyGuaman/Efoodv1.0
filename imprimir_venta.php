<?php
include_once('conexion/db.php');
?>
<link rel="stylesheet" href="plugins/select2/select2.min.css">
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
    Fpedido();
    detallepedido();
    BnumVenta();
    btnCancelar();
});


function btnCancelar(){
  $("#btn_cancelar").click(function(){
   swal({   title: "¿Estás seguro?",text: "De cancelar el proceso!",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Si, Cancelar!",cancelButtonText: "No",closeOnConfirm: false,closeOnCancel: true 
  },
   function(isConfirm){ 
         if (isConfirm) {     
              swal("Se a cancelado!", "Sera redireccionado al inicio", "success");   
              cambiarcont('movimiento_mesa.php');
          }  
     });
  });
}

function BnumVenta(){
$.ajax({ url:'ventas/buscar_numVenta.php', type:'POST', dataType:'json',
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

function Fpedido(){
var id=$("#idpedio_txt").val();
$.ajax({    url:'Modelo/buscar_pedido.php', type:'POST', dataType:'json',data:{id:id},
      success:function(response){
        if(response.respuesta==true){
          $("#total_p").val(response.total);
          $("#subtotal").val(response.subtotal);
          $('#iva12').val(response.iva);
          $('#totalp').val(response.total);
        }else
            {
              new PNotify({title: 'A ocurrido un error inesperado',text: 'Error el pedido no encontrado',type: 'error',delay: 2000});
              cambiarcont('movimiento_mesa.php');             
            }
      }
});
}

function detallepedido(){
  var id = $("#idpedio_txt").val();
           $.ajax({url:'Modelo/buscar_detalleP.php',type:'POST', data:{id:id},
                  success:function(response){
                      $("#tproductos").html(response)         
                  }     
            });
}

function ventas(){
  var idpedido =$("#idpedido_txt").val();
    $.ajax({
      url:'Modelo/buscar_venta.php',
      type:'POST',
      dataType:'json',
      data:{idpedido:idpedido},
      success:function(response){

      }
    });
}
</script>


<style>
  pre{
    overflow: hidden;
    padding: 0;
    margin: 0 0 10px;
    background-color: #fff;
    border: 0px solid #ccc;
  }
.precio input{
  text-align: center;
  border: 0;
  width: 40px;
}

.fila input{
text-align: center;
width: 50px;
}
.fila_total input{
border: 0;
text-align: center;
width: 40px;
}
.panel-body {
    padding: 33px;
}
.filas input{
border: 0;
text-align: center;
}
.aceptado_Cliente{
margin-top: 5px;
color: blue;
}
.negar_cliente{
margin-top: 5px;
color: red;

}
.margen{
margin-top: 25px;
}

.margen select{
border-radius: 10px;
}
.btn_add {
margin-top: 25px;
}
.nfactura input{
text-align: center;
border: 0;
font-size: 18;

color: red;
}
.alinear_der{
margin-left: 30px;

}
.alinear_dere input{
width: auto;
background: #f39c12;
text-decoration-color: #111;
text-align: right;
border: 0;
}
.alinear_der input{
text-align: right;
border: 0;
}
.ValorP{
margin-top: 10px;
border-radius: 7px;
background: #f39c12;
padding: 1em;
font-family: sans-serif;
 box-shadow:  0px 5px 5px rgba(0, 0, 0, 0.5);

}
.Panel_producto{
border-radius: 1em;
padding: 1em;
}
.total{
background-color: #333;
padding: 1em;
border-radius: 10px;
text-align: center;
margin: 1em auto;
margin-bottom: 15px;
margin-top: 15px;
}

.total input{
font-size: 34px;
font-family: "Square721 BT";
background: #333;
border: 0;
width: 60%;
color: #00d347;
padding: 0.5em;
margin-top: 10px;
text-align: center;
}
.boton_limpirar{
align-content:center;
}
.color_rojo{
color: red;
}

.centrar_input{
margin-left: 70px;
}
th{
color:blue;
}
</style>

<script language="javascript">

  function imprSelec(nombre)
  {
    /*contenido=document.getElementById(nombre).outterHTML; 
ventana=window.open("about:blank","ventana","width=700,height=600,top=0;left:3000"); 
ventana.title="Imprimiendo..." 
ventana.document.open(); 
ventana.document.write(contenido); 
ventana.document.close(); 
ventana.print; 
ventana.onprint=ventana.close(); */
  var ficha = document.getElementById(nombre);
  var ventimp = window.open(' ', 'popimpr');
  ventimp.document.write( ficha.innerHTML );
  ventimp.document.close();
  ventimp.print();
  ventimp.close();
  } 

</script> 
<div class="container-fluid"> <!-- Page Heading -->
<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">
      Imprimir factura
    </h1>
  </div>
</div><!-- /.row -->
<div class="col-md-12">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Registro de Pedidos - 
      </h3>
    </div><!-- /.box-header -->
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="Imprime">
          <?php 
            date_default_timezone_set("America/Guayaquil"); 
            $fecha = date("Y/m/d H:i:s"); 
            //se obtiene la sucursal respecto al usuario que inicio sesion
            $totalV = 0;
            $totalCosto =0;
            $totalImporte=0;
            $cont=1;
          ?>
           <style type="text/css">
            p{  margin-top: 0px;  margin-bottom: 0px;}
          </style>
          <p style="margin-top:0px; margin-bottom:0px;">*RESTAURANTE EL TOMATE*</p> 
          <p style="margin-top:0px; margin-bottom:0px; margin-left:50px;">DIRECCION:</p> 
          <p style="margin-top:0px; margin-bottom:0px; margin-left:20px;">VIA CRUCITA KM 1/2</p> 
          <p style="margin-top:0px; margin-bottom:0px; margin-left:6px;">PORTOVIEJO - ECUADOR</p> 
            <br>
          <p>Restaurante: El Tomate</p>
          <p>RUC: 1312320366001</p><p>N°.<?php $numero = pg_query($conexion,"select desde from rangosruc where ruc='1312320466001'");
           while($n=pg_fetch_array($numero)){
                if($n['0']<10){
                  $nv=$n['0']-1;
                  echo "00000000".$nv;
                }else if(n['0']<100){
                  $nv=$n['0']-1;
                  echo "0000000".$nv;
                }else if(n['0']<1000){
                  $nv=$n['0']-1;
                  echo "000000".$nv;
                }
              } ?> </p>
          <p>--------------------------------------------------------------</p>
            <pre>Descripcion  Cantidad  Pvp   Subtotal</pre>
          <p>--------------------------------------------------------------</p>
            <table width="300" border="0">
          <?php
            $totalCosto=0;
            $cliente='';
            $iva0='';
            $iva12='';
            $consulta =pg_query($conexion,("SELECT concat(personas.nombre,' ',personas.apellidopat) as cliente ,platos.nombreplato,detalleventa.cantidad,detalleventa.pvp, detalleventa.subtotal,ventas.subtotal,ventas.iva12,ventas.iva0
              from detalleventa,platos,ventas,personas,cliente
              where idventa=(select max(id) from ventas)
              and platos.id=detalleventa.idplato
              and ventas.id=detalleventa.idventa
              and platos.idtipo!=8
              and personas.id=(select idpersona from cliente where id=(select idcliente from ventas where id=(select max(id) from ventas)))
              and cliente.id=(select idcliente from ventas where id=(select max(id) from ventas))"));
              while($tipo=pg_fetch_array($consulta)){
                echo "<tr>";
                echo "    <td width='60'>".$tipo['1']."</td>";
                echo "    <td width='40'>".$tipo['2']."</td>";
                echo "    <td width='40'>".$tipo['3']."</td>";
                echo "    <td width='40'>".$tipo['4']."</td>";
                echo "</tr>";
                $cliente=$tipo['0'];
                $totalCosto=$totalCosto+$tipo['4'];
                $iva12=$tipo['6'];
                $iva0=$tipo['7'];
                $cont=$cont+1;
              }
          ?>
            </table>
          <p>--------------------------------------------------------------</p>
          <pre>   Valor            :           <?php echo $totalCosto?></pre>
          <pre>
   Tarifa 0         :           <?php echo $iva0?></pre>
          <pre>
   Tarifa 12        :           0,00</pre>
          <pre>
   12% IVA          :           0,00</pre>
          <pre>
   TOTAL            :           <?php echo $totalCosto?></pre>
          <p>--------------------------------------------------------------</p>
          <p style="margin-left:40px;"> Efood 2016 v1.0</p>
          <p>CLIENTE: <?php echo $cliente?></p>
          <p>CED/RUC: <?php //paramatro recibe ?></p>
          <p>Fecha Emisión: <?php echo $fecha ?></p>
          <p>Autorización SRI: <?php //paramatro recibe ?></p>
          <br>
          <p>Firma Cliente: </p>
          <p>-------------------------------------</p>
          <br>
        </div><!--fin del div imprimir -->
          <p><a href="javascript:imprSelec('Imprime')" ><img src="dist/img/print-2.png" width="46" height="46" /></a></p>   
      </div>
    </div>
  </div> <!--fin del col-md-7-->
<div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="Imprime2">
          <?php 
            date_default_timezone_set("America/Guayaquil"); 
            $fecha = date("Y/m/d H:i:s"); 
            //se obtiene la sucursal respecto al usuario que inicio sesion
            $totalV = 0;
            $totalCosto =0;
            $totalImporte=0;
            $cont=1;
          ?>
           <style type="text/css">
            p{  margin-top: 0px;  margin-bottom: 0px;}
          </style>
          <p style="margin-top:0px; margin-bottom:0px;">*RESTAURANTE EL TOMATE*</p> 
          <p style="margin-top:0px; margin-bottom:0px; margin-left:50px;">DIRECCION:</p> 
          <p style="margin-top:0px; margin-bottom:0px; margin-left:20px;">VIA CRUCITA KM 1/2</p> 
          <p style="margin-top:0px; margin-bottom:0px; margin-left:6px;">PORTOVIEJO - ECUADOR</p> 
            <br>
          <p>Restaurante: El Tomate</p>
          <p>RUC:1314888015001</p><p>N°.<?php $numero = pg_query($conexion,"select desde from rangosruc where ruc='1314888015001'");
           while($n=pg_fetch_array($numero)){
                if($n['0']<10){
                  $nv=$n['0']-1;
                  echo "00000000".$nv;
                }else if(n['0']<100){
                  $nv=$n['0']-1;
                  echo "0000000".$nv;
                }else if(n['0']<1000){
                  $nv=$n['0']-1;
                  echo "000000".$nv;
                }
              } ?></p>
          <p>--------------------------------------------------------------</p>
            <pre>Descripcion  Cantidad  Pvp   Subtotal</pre>
          <p>--------------------------------------------------------------</p>
            <table width="300" border="0">
          <?php
          $iva_12=0;
          $tarifa12=0;
            $consulta =pg_query($conexion,("SELECT concat(personas.nombre,' ',personas.apellidopat) as cliente ,platos.nombreplato,detalleventa.cantidad,detalleventa.pvp, detalleventa.subtotal,ventas.subtotal,ventas.iva12 
              from detalleventa,platos,ventas,personas,cliente
              where idventa=(select max(id) from ventas)
              and platos.id=detalleventa.idplato
              and ventas.id=detalleventa.idventa
              and platos.idtipo =8
              and personas.id=(select idpersona from cliente where id=(select idcliente from ventas where id=(select max(id) from ventas)))
              and cliente.id=(select idcliente from ventas where id=(select max(id) from ventas))"));
              while($tipo=pg_fetch_array($consulta)){
                echo "<tr>";
                echo "    <td width='60'>".$tipo['1']."</td>";
                echo "    <td width='40'>".$tipo['2']."</td>";
                echo "    <td width='40'>".$tipo['3']."</td>";
                echo "    <td width='40'>".$tipo['4']."</td>";
                echo "</tr>";
                $tarifa12=$tarifa12+$tipo['4'];
                $iva_12=$tipo['6'];
                $cont=$cont+1;
              }
          ?>
            </table>
          <p>--------------------------------------------------------------</p>
          <pre>   Valor            :           <?php echo $tarifa12?></pre>
          <pre>
   Tarifa 0         :           0.0</pre>
          <pre>
   Tarifa 12        :           <?php echo $tarifa12?></pre>
          <pre>
   12% IVA          :           <?php echo $tarifa12*0.12?></pre>
          <pre>
   TOTAL            :           <?php echo $iva12?></pre>
          <p>--------------------------------------------------------------</p>
          <p style="margin-left:40px;"> Efood 2016 v1.0</p>
          <p>CLIENTE: <?php echo $cliente?></p>
          <p>CED/RUC: <?php //paramatro recibe ?></p>
          <p>Fecha Emisión: <?php echo $fecha ?></p>
          <p>Autorización SRI: <?php //paramatro recibe ?></p>
          <br>
          <p>Firma Cliente: </p>
          <p>-------------------------------------</p>
          <br>
        </div><!--fin del div imprimir -->
          <p><a href="javascript:imprSelec('Imprime2')" ><img src="dist/img/print-2.png" width="46" height="46" /></a></p>   
      </div>
    </div>
  </div> <!--fin del col-md-7-->

  <div class="col-md-4">
   <div class="panel panel-default">
      <div class="panel-body">
        <div id="nFactura" class="text-center">
          <label for="numero">Numero de Venta: </label>
          <div class="input-group nfactura">
            <input type="text" class="form-control centrar_input"  id="nfactura" placeholder="0000001" disabled="false">
          </div>
        </div>
      </div>
    </div> <!--fin del panel para el numero de Factura-->

    
    </div> <!--fin del panel para el Total a pagar-->
  </div>
</div><!-- /.box -->
</div>




