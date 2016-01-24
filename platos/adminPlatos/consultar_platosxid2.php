<?php
include_once('../../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select platos.id,platos.nombreplato,platos.idtipo,platos.idxcantidad,platos.precio, platos.dias_disponibles from platos where  platos.id=$id"));
$Platos=pg_fetch_array($consulta);
$resul=array('Pid'=>$Platos[0],'Pnombre'=>$Platos[1],'Ptipo'=>$Platos[2],'Pxcant'=>$Platos[3],'Pprecio'=>$Platos[4],'Pdias'=>$Platos[5]);
echo json_encode($resul);

?>
