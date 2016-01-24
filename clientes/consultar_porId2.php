<?php
include_once('../conexion/db.php');
$id =$_POST['id'];

$consulta =pg_query($conexion,("select personas.id,cliente.id,personas.nombre,personas.apellidopat,personas.apellidomat,personas.cedula,personas.direccion,personas.telefono from personas,cliente where personas.id =cliente.idpersona and personas.id=$id"));
$Cliente=pg_fetch_array($consulta);
$resul=array('Pid'=>$Cliente[0],'Cid'=>$Cliente[1],'Cnombre'=>$Cliente[2],'CapeP'=>$Cliente[3],'CapeM'=>$Cliente[4],'Ccedula'=>$Cliente[5],'Cdirecion'=>$Cliente[6],'Ctelefono'=>$Cliente[7]);
echo json_encode($resul);

?>
