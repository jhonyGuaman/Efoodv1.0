<?php
include_once('../conexion/db.php');

$producto=$_POST['producto'];
$mensajeok=false;
$mensajeResul="No se encontro";
//$cliente_="vacio";

$sql =pg_query($conexion,("select nombreplato from platos,bebidas where platos.id=bebidas.idplato and nombreplato ilike '$producto%'"));
if(pg_num_rows($sql)>0):
  $mensajeok=true;
  $Productos=pg_fetch_array($sql);
  $mensajeResul=$Productos[0];
  //$cliente_ =$Cliente[1];
endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeResul);
echo json_encode($salidaJson);
?>
