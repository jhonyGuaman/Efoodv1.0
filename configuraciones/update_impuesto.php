<?php
include_once('../conexion/db.php');

$id=$_POST['idI'];
$impuesto=$_POST['impuesto'];
$valor=$_POST['valor'];
$estado=$_POST['estado'];


$consulta =pg_query($conexion,("UPDATE impuestos SET impuesto='$impuesto',valor='$valor',estado='$estado' WHERE id=$id"));
$update_estados =pg_query($conexion,("UPDATE impuestos SET estado='desactivado' WHERE id !=$id"));

include('consultar_impuestos.php');

?>
