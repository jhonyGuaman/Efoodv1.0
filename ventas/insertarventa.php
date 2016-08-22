<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';
$idmesa=0;
  $idpedido=$_POST['idpedido'];
  $idcliente=$_POST['idcliente'];
  $subtotal=$_POST['subtotal'];
  $iva=$_POST['iva12'];
  $iva0=$_POST['iva0'];
  $total=$_POST['total'];
  $numeroV1=$_POST['numeroV1'];
  $numeroV2=$_POST['numeroV2'];
  $fecha=$_POST['fecha'];
  $ruc1=$_POST['ruc1']; 
  $ruc2=$_POST['ruc2']; 
  
  $sql2=pg_query($conexion,("SELECT mesa.id from mesa,pedido where pedido.idmesa=mesa.id and pedido.id=$idpedido"));
    if(pg_num_rows($sql2)>0):
    $Cliente = pg_fetch_array($sql2);
    $idmesa      = $Cliente[0];
endif;
$sql=pg_query($conexion,("insert into ventas(idcliente,subtotal,iva12,totalpagado,numeroventa,fecha,iva0,numeroventa2)
							values('$idcliente','$subtotal','$iva','$total','$numeroV1','$fecha','$iva0','$numeroV2')"));
 if(!$sql):
        $mensajeError="Error a insertar los datos en la tabla platos";
      else:
        $consulta =pg_query($conexion,("UPDATE pedido SET estado='cancelado' WHERE id=$idpedido"));
        $consul =pg_query($conexion,("UPDATE mesa SET estado=0, idusuario=0 where id=$idmesa"));
        if($ruc1!=""){
        $A_rango= pg_query($conexion,("UPDATE rangosruc set desde=$numeroV1+1 where ruc='".$ruc1."'"));
        }
        if($ruc2!=""){
        $A_rango= pg_query($conexion,("UPDATE rangosruc set desde=$numeroV2+1 where ruc='".$ruc2."'"));
        }
        
        $mensajeError="Venta Registrado  Correctamente.";
        $mensajeok=true;

endif;
  



$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
