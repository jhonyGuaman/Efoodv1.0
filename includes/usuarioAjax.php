<?php
include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
/*var_dump($_POST);
exit;*/
 if(isset($_POST['cedula'],$_POST['usuario'],$_POST['telefono'],$_POST['clave'])):
 	$nombre=$_POST['nombre'];
 	$apellidopat=$_POST['apellidopat'];
 	$apellidomat=$_POST['apellidomat'];
 	$cedula=$_POST['cedula'];
 	$usuario=$_POST['usuario'];
 	$telefono=$_POST['telefono'];
 	$clave=$_POST['clave'];
 	$foto=$_POST['foto'];
 	$direcion=$_POST['direcion'];
  $tipo=$_POST['tipo'];
	$foto0=$_POST['foto'];
 	$foto="subirfoto/".$foto0;
 	$insertar=pg_query($conexion,"insert into personas(nombre,apellidopat,apellidomat,cedula,direccion,telefono) values ('$nombre','$apellidopat','$apellidomat','$cedula','$direcion','$telefono')");
		if(!$insertar):
				$mensajeError='Error al insertar Usuario';
	//BUSCAMOS EN ID DEL PERSONA QUE SE REGISTRO
		else:
						$getbyeId=pg_query($conexion,"select max(id) from personas");
		 					if(pg_num_rows($getbyeId)>0):
		 						$Usua=pg_fetch_array($getbyeId);
		 						$getid=$Usua[0];
								$insertar2=pg_query($conexion,"insert into usuarios(idpersona,username,clave,foto,tipo) values('$getid','$usuario','$clave','$foto','$tipo')") ;
								$mensajeError="Usuario Registrado";
								$mensajeok=true;
		 					else:
		 						$mensajeError='usuario no encontrado';
		 					endif;
		endif;
  					// INSERTAMOS NUEVO USUARIOS
else:
 		$mensajeError='Todos los datos son requeridos 2';
endif;
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);
?>
