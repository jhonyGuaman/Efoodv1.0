<?php
include_once('../conexion/db.php');

$idplato=$_POST['idplato'];
$idpedido=$_POST['idpedido'];
$mensajeok='iva0';
$mensajeResul="No se encontro";
$impuesto='';
$ivaValor='';

$numeroFactura1=0;
$numeroFactura2=0;
$ruc1="";
$ruc2="";

$ivaA =pg_query($conexion,"SELECT impuesto,valor from impuestos where estado='activo'");
if(pg_num_rows($ivaA)>0){
  		$piva=pg_fetch_array($ivaA);
  		$impuesto=$piva[0];
  		$ivaValor=$piva[1];
}

$sql =pg_query($conexion,("SELECT pedidodetalle.subtotal FROM pedidodetalle,pedido,platos	
						   WHERE pedido.id=$idpedido
						   AND platos.idtipo=8
						   and platos.id=$idplato
						   AND pedido.id=pedidodetalle.idpedido 
						   AND pedidodetalle.idplato=$idplato"));
	if(pg_num_rows($sql)>0){
  		$mensajeok="Si"; 
      $piva=pg_fetch_array($sql);
  		$mensajeResul=$piva[0];
         $sql_numero2 = pg_query($conexion,("select desde from rangosruc where ruc='1314888015001'"));
            if(pg_num_rows($sql_numero2)>0){
              $numeroF2=pg_fetch_array($sql_numero2);
              $numeroFactura2=$numeroF2[0];
              $ruc2="1314888015001";
            }
            
    }
  	else{
  		$sql1=pg_query($conexion,("SELECT pedidodetalle.subtotal from pedidodetalle,pedido,platos
									where pedido.id=$idpedido
									and platos.id=$idplato
									and pedido.id=pedidodetalle.idpedido 
									and pedidodetalle.idplato=$idplato"));
  		if(pg_num_rows($sql1)>0){
  		$mensajeok="No";
  		$piva=pg_fetch_array($sql1);
  		$mensajeResul=$piva[0];
            $sql_numero = pg_query($conexion,("select desde from rangosruc where ruc='1312320466001'"));
            if(pg_num_rows($sql_numero)>0){
              $numeroF=pg_fetch_array($sql_numero);
              $numeroFactura1=$numeroF[0];
              $ruc1="1312320466001";

            }
  		}
	}

$salidaJson=array('respuesta'=> $mensajeok, 'iva' => $mensajeResul,'impuesto' =>$impuesto,'valor'=>$ivaValor,'numeroFa1'=> $numeroFactura1,'numeroFa2'=>$numeroFactura2,'ruc1'=>$ruc1,'ruc2'=>$ruc2);
echo json_encode($salidaJson);
?>
