<?php
include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
/*var_dump($_POST);
exit;*/
if(isset($_POST['nombreP'],$_POST['precio'],$_POST['cantidad'])):
 	$nombreP=$_POST['nombreP'];
 	$precio=$_POST['precio'];
 	$cantidad=$_POST['cantidad'];
 	$idtipo=$_POST['idtipo'];
 	$dias=$_POST['dias'];
	

	$insertar=pg_query($conexion,"insert into platos(nombreplato,precio,idtipo,dias_disponibles,cantidad) values ('$nombreP','$precio','$idtipo','$dias','$cantidad')");

	if(!$insertar):
				$mensajeError="Error a insertar los datos en la tabla platos";
			else:
				$getbyeId=pg_query($conexion,"select max(id) from platos");
		 					if(pg_num_rows($getbyeId)>0):
		 						
		 						$Usua=pg_fetch_array($getbyeId);
		 						$getid=$Usua[0];
		 						// $mensajeError="Id de Persona encontrado";

					 				$insertar2=pg_query($conexion,"insert into bebidas(idplato) values('$getid')") ;	
					 							if($insertar2):
														$mensajeError="Bebida se Registro Correctamente.";
														$mensajeok=true;
												else:
														$mensajeError="Error a insertar los datos en la tabla bebidas";
												endif;

			
		 					else:
		 						$mensajeError='Error al encontrar el id de la bebida';

		 					endif;
	endif; 

else:
	$mensajeError='Todos los datos son necesarios por favor.';

endif;
	
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);

?>
	