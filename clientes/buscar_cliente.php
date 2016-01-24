<?php
include_once('../conexion/db.php');
$cedula =$_POST['cedula'];
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';

$consulta =pg_query($conexion,("select * from personas,cliente where cedula='$cedula' and personas.id=cliente.idpersona"));
if(pg_num_rows($consulta)>0):
  //$Usua=pg_fetch_array($getbyeId);
  //$getid=$Usua[0];
  //$insertar2=pg_query($conexion,"insert into usuarios(idpersona,username,clave,foto,tipo) values('$getid','$usuario','$clave','$foto','$tipo')") ;
  $mensajeError="Cliente ya se encuentra registrado en el sistema";
  $mensajeok=true;
else:
  $mensajeError='Null';
endif;
$resul=array('respuesta'=>$mensajeok,'mensaje'=>$mensajeError);
echo json_encode($resul);

?>
