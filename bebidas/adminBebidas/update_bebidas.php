<?php
include_once('../../conexion/db.php');

$Pid=$_POST['id'];
$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];
$categoria=$_POST['categoria'];
$dias=$_POST['dias'];

$consulta =pg_query($conexion,("UPDATE platos SET nombreplato='$nombre',precio='$precio',idtipo='$categoria' , dias_disponibles='$dias' , cantidad='$cantidad' WHERE id=$Pid"));
include('consulta_bebidas2.php');

?>
