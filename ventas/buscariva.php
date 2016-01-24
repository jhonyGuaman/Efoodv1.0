<?php
include_once('../conexion/db.php');

$valor=$_POST['idS'];
$mensajeok='';
$mensajeResul="No se encontro";

$sql =pg_query($conexion,("select productos.precio_iva from productos where iva='12%' and productos.id='$valor'"));
if(pg_num_rows($sql)>0):
  $mensajeok="iva12";
  $piva=pg_fetch_array($sql);
  $mensajeResul=$piva[0];
else:
    $sql =pg_query($conexion,("select productos.precio_iva from productos where iva='0 %' and productos.id='$valor'"));
    if(pg_num_rows($sql)>0):
      $mensajeok="iva0";
      $piva=pg_fetch_array($sql);
      $mensajeResul=$piva[0];
    endif;
endif;

$salidaJson=array('respuesta'=> $mensajeok, 'iva' => $mensajeResul);
echo json_encode($salidaJson);
?>
