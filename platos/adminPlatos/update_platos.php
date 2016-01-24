<?php
include_once('../../conexion/db.php');

$Pid=$_POST['id'];
//$Cid=$_POST['idclient'];
$nombre=$_POST['nombre'];
$precio=$_POST['precio'];
$idtipo=$_POST['idTipo'];
$idxcantidad=$_POST['idcant'];
$dias=$_POST['dias'];

$consulta =pg_query($conexion,("UPDATE platos SET nombreplato='$nombre',idtipo='$idtipo',idxcantidad='$idxcantidad',precio='$precio', dias_disponibles='$dias' WHERE id=$Pid"));

include('consulta_platos2.php');

?>
