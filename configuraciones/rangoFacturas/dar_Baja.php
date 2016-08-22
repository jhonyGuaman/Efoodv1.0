<?php
include_once('../../conexion/db.php');

$id=$_POST['id'];
$desde=$_POST['desde'];

$consulta =pg_query($conexion,("UPDATE rangosruc SET desde='$desde' WHERE id=$id"));
include('consultar_rangos.php');
?>

