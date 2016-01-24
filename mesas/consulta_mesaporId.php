<?php
include_once('../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select * from mesa where id=$id" ));
$Mesa=pg_fetch_array($consulta);
//$_SESSION['id_tipoplato']=$Usua[0];
//$_SESSION['categoria_tipoplato']=$Usua[1];
$resul=array('Mid'=>$Mesa[0],'Mnumero'=>$Mesa[1]);
echo json_encode($resul);
?>
