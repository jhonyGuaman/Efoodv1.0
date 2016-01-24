<?php
include_once('../conexion/db.php');

$Pid=$_POST['idP'];
//$Cid=$_POST['idclient'];
$nombre=$_POST['nombre'];
$apeP=$_POST['apePat'];
$apeM=$_POST['apeMat'];
$cedula=$_POST['cedula'];
$direcion=$_POST['direcion'];
$telefono=$_POST['telefono'];
$clave =$_POST['clave'];
echo "Variable Vacia".$Pid;
$consulta =pg_query($conexion,("UPDATE personas SET nombre='$nombre',apellidopat='$apeP',apellidomat='$apeM',cedula='$cedula',direccion='$direcion',telefono='$telefono' WHERE id='$Pid'"));
$consulta2 = pg_query($conexion,("UPDATE usuarios SET clave='$clave' WHERE idpersona='$Pid'"));

include('consulta_usuarios.php');

?>
