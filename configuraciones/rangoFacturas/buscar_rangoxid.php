<?php
include_once('../../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select * from rangosruc where id=$id" ));
$rangos=pg_fetch_array($consulta);
$resul=array('Rid'=>$rangos[0],'Rruc'=>$rangos[1],'Rdesde'=>$rangos[2],'Rhasta'=>$rangos[3]);
echo json_encode($resul);
?>
