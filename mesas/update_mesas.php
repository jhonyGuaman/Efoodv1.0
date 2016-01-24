<?php
include_once('../conexion/db.php');

$id=$_POST['idMe'];
$num_mesa=$_POST['num_mesa'];

$consulta =pg_query($conexion,("UPDATE mesa SET numero_mesa='$num_mesa' WHERE id=$id"));

include('consulta_mesas.php');

?>
