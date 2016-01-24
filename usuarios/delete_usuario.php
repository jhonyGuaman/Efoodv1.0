<?php
include_once('../conexion/db.php');
//variable GET
$id=$_POST['id'];
// buscamos el id del usuario en la tabla personas

$idP=pg_query($conexion,("Select idpersona from usuarios where usuarios.id=$id"));
while($tipo=pg_fetch_array($idP)){
 $resul=$tipo['0'];
}
$sql="DELETE FROM usuarios WHERE id=$id";
pg_query($conexion,$sql);

//elimina el registro de la tabla empleados

$sql1="DELETE FROM personas WHERE id=$resul";
pg_query($conexion,$sql1);

//mysql_query($sql,$con);

include('consulta_usuarios.php');

?>
