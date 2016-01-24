<?php
include_once('../conexion/db.php');

$id=$_POST['idlib'];
$categoria=$_POST['categoria_update'];

$consulta =pg_query($conexion,("UPDATE tipoplato SET categoria='$categoria' WHERE id=$id"));

include('consulta_tipoplato.php');

?>
