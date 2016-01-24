<?php
include_once('../conexion/db.php');

$plato=$_POST['plato'];
$mensajeok=false;
$mensajeResul="No se encontro";
//$cliente_="vacio";

$sql =pg_query($conexion,("select nombreplato from platos where nombreplato ilike '$plato%'"));
if(pg_num_rows($sql)>0):
  $mensajeok=true;
  $Cliente=pg_fetch_array($sql);
  $mensajeResul=$Cliente[0];
  //$cliente_ =$Cliente[1];
endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeResul);
echo json_encode($salidaJson);
?>
