<?php
include_once('../conexion/db.php');
$cedula =$_POST['cedula'];
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';

$consulta =pg_query($conexion,("select * from personas,usuarios where personas.cedula='$cedula' and personas.id=usuarios.idpersona"));
if(pg_num_rows($consulta)>0):
  //$Usua=pg_fetch_array($getbyeId);
  //$getid=$Usua[0];
  //$insertar2=pg_query($conexion,"insert into usuarios(idpersona,username,clave,foto,tipo) values('$getid','$usuario','$clave','$foto','$tipo')") ;
  $mensajeError="Usuario Encontrado";
  $mensajeok=true;
else:
  $mensajeError='usuario no encontrado';
endif;
$resul=array('respuesta'=>$mensajeok,'mensaje'=>$mensajeError);
echo json_encode($resul);

?>
