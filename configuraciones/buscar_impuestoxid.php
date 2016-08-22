<?php
include_once('../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select * from impuestos where id=$id" ));
$Impuesto=pg_fetch_array($consulta);
$resul=array('Iid'=>$Impuesto[0],'Iimpuesto'=>$Impuesto[1],'Ivalor'=>$Impuesto[2],'Iestado'=>$Impuesto[3]);
echo json_encode($resul);
?>
