<?php
include_once('../../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select platos.id,platos.nombreplato,platos.precio,platos.cantidad,productosind.iva,productosind.precioiva,platos.idtipo,platos.dias_disponibles 
								from platos,productosind 
								where platos.id=productosind.idplato and platos.id=$id"));
$Platos=pg_fetch_array($consulta);
$resul=array('Pid'=>$Platos[0],'Pnombre'=>$Platos[1],'Pprecio'=>$Platos[2],'Pcantidad'=>$Platos[3],'Piva'=>$Platos[4],'Pprecioiva'=>$Platos[5],'Pcategoria'=>$Platos[6],'Pdias'=>$Platos[7]);
echo json_encode($resul);

?>
