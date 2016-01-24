<?php
include_once('../conexion/db.php');

$Pid=$_POST['idclien'];
//$Cid=$_POST['idclient'];
$nombre=$_POST['nombre'];
$apeP=$_POST['apePat'];
$apeM=$_POST['apeMat'];
$cedula=$_POST['cedula'];
$direcion=$_POST['direcion'];
$telefono=$_POST['telefono'];

$consulta =pg_query($conexion,("UPDATE personas SET nombre='$nombre',apellidopat='$apeP',apellidomat='$apeM',cedula='$cedula',direccion='$direcion',telefono='$telefono' WHERE id=$Pid"));

include('consulta_clientes.php');

?>
