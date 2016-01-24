<?php
include_once('db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
/*var_dump($_POST);
exit;*/
if(isset($_POST['archivo'])):
 	$ruta=$_POST['archivo'];
 	
	$insertar=pg_query($conexion,"insert into foto(ruta) values ('$ruta')");

	if(!$insertar):
				$mensajeError="Error a insertar los datos en la tabla persona";
			else:
				$mensajeError="Se guardo la foto correcta";
				$mensajeok=true;
	endif; 

else:
	$mensajeError='No ha seleccionado ninguna Foto.';

endif;
	
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);

?>
	