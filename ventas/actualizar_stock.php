<?php
include_once('../conexion/db.php');

$id=$_POST['codigo'];
$cantidad=$_POST['Cantidad'];

$sql= pg_query($conexion,())

/// coger el id de los platps y buscar en la tabla presas y porplatos y porductos indus
///con if
$consulta =pg_query($conexion,("UPDATE tipocantidad SET tipo='$categoria' WHERE id=$id"));

include('consulta_tipocant.php');

?>
