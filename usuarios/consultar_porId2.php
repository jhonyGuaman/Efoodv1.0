<?php
include_once('../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select personas.id,usuarios.id,personas.nombre,personas.apellidopat,personas.apellidomat,personas.cedula,personas.direccion,personas.telefono,usuarios.clave from personas,usuarios where personas.id =usuarios.idpersona and usuarios.id=$id"));
$Cliente=pg_fetch_array($consulta);
$resul=array('Pid'=>$Cliente[0],'Uid'=>$Cliente[1],'Unombre'=>$Cliente[2],'UapeP'=>$Cliente[3],'UapeM'=>$Cliente[4],'Ucedula'=>$Cliente[5],'Udirecion'=>$Cliente[6],'Utelefono'=>$Cliente[7],'Uclave'=>$Cliente[8]);
echo json_encode($resul);

?>
