<?php
include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
/*var_dump($_POST);
exit;*/
if(isset($_POST['cedula'],$_POST['nombre'],$_POST['telefono'])):
 	$nombre=$_POST['nombre'];
 	$apellidopat=$_POST['apellidopat'];
 	$apellidomat=$_POST['apellidomat'];
 	$cedula=$_POST['cedula'];
 	$telefono=$_POST['telefono'];
	$direcion=$_POST['direcion'];

	$insertar=pg_query($conexion,"insert into personas(nombre,apellidopat,apellidomat,cedula,telefono,direccion) values ('$nombre','$apellidopat','$apellidomat','$cedula','$telefono','$direcion')");

	if(!$insertar):
				$mensajeError="Error a insertar los datos en la tabla persona";
			else:
				$getbyeId=pg_query($conexion,"select max(id) from personas");
		 					if(pg_num_rows($getbyeId)>0):
		 						
		 						$Usua=pg_fetch_array($getbyeId);
		 						session_start();
		 						$getid=$Usua[0];
		 						// $mensajeError="Id de Persona encontrado";

					 				$insertar2=pg_query($conexion,"insert into cliente(idpersona) values('$getid')") ;	
					 							if($insertar2):
														$mensajeError="El Cliente se Registro Correctamente.";
														$mensajeok=true;
												else:
														$mensajeError="Error a insertar los datos en la tabla cliente";
												endif;

			
		 					else:
		 						$mensajeError='Error al encontrar el id de la persona';

		 					endif;
	endif; 

else:
	$mensajeError='Todos los datos son necesarios por favor.';

endif;
	
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);

?>
	