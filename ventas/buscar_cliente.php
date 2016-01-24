<?php
include_once('../conexion/db.php');

$bus=$_POST['cedula'];
$mensajeok=false;
$mensajeResul="No se encontro";
$cliente_="vacio";

$sql =pg_query($conexion,("select personas.cedula,concat(personas.nombre,' ',personas.apellidopat)as cliente from personas,cliente where personas.id=cliente.idpersona and personas.cedula ilike '%$bus%'"));
if(pg_num_rows($sql)>0):
  $mensajeok=true;
  $Cliente=pg_fetch_array($sql);
  $mensajeResul=$Cliente[0];
  $cliente_ =$Cliente[1];
endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeResul,'cliente'=>$cliente_);
echo json_encode($salidaJson);
?>
