<?php
include_once('../../conexion/db.php');

$id=$_POST['id'];
$ruc=$_POST['ruc'];
$desde=$_POST['desde'];
$hasta=$_POST['hasta'];


$consulta =pg_query($conexion,("UPDATE rangosruc SET ruc='$ruc',desde='$desde',hasta='$hasta' WHERE id=$id"));
include('consultar_rangos.php');
?>


