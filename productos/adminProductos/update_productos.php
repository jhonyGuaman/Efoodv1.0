<?php
include_once('../../conexion/db.php');

$Pid=$_POST['id'];
$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];
$iva=$_POST['iva'];
$idtipo=$_POST['idtipo'];
$dias=$_POST['dias'];
$precioiva=$_POST['precio_iva'];

$consulta =pg_query($conexion,("UPDATE platos SET nombreplato='$nombre',idtipo='$idtipo',precio='$precio',dias_disponibles='$dias' ,cantidad='$cantidad' WHERE id=$Pid"));
$consulta =pg_query($conexion,("UPDATE productosind SET iva='$iva',precioiva=$precioiva WHERE idplato=$Pid"));
include('consulta_productos2.php');

?>
