<?php
include_once('../conexion/db.php');
//variable GET
$id=$_POST['id'];

//elimina el registro de la tabla empleados
$sql="DELETE FROM impuestos WHERE id=$id";
pg_query($conexion,$sql);
//mysql_query($sql,$con);

include('consultar_impuestos.php');
?>
