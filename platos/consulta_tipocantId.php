<?php
include_once('../conexion/db.php');
$id =$_POST['id'];
$consulta =pg_query($conexion,("select * from tipocantidad where id=$id" ));
$Usua=pg_fetch_array($consulta);
//$_SESSION['id_tipoplato']=$Usua[0];
//$_SESSION['categoria_tipoplato']=$Usua[1];
$resul=array('Rid'=>$Usua[0],'Rtipo'=>$Usua[1]);
echo json_encode($resul);
?>
