<?php
include_once('../../conexion/db.php');
//variable GET
$id=$_POST['id'];

//elimina el registro de la tabla empleados
$consulta2 =pg_query($conexion,("DELETE FROM bebidas WHERE idplato=$id"));

$sql=pg_query($conexion,("DELETE FROM platos WHERE id=$id"));


//mysql_query($sql,$con);

include('consulta_bebidas2.php');
?>
