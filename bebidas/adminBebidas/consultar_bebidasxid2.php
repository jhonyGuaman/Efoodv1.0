<?php
include_once('../../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select platos.id,platos.nombreplato,platos.precio,platos.cantidad,platos.idtipo,platos.dias_disponibles from platos,bebidas where platos.id=bebidas.idplato and platos.id=$id"));
$Platos=pg_fetch_array($consulta);
$resul=array('Bid'=>$Platos[0],'Bnombre'=>$Platos[1],'Bprec'=>$Platos[2],'Bcantidad'=>$Platos[3],'Bcategoria'=>$Platos[4],'bdias'=>$Platos[5]);
echo json_encode($resul);

?>
