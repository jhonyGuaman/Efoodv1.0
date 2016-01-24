<?php
include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
/*var_dump($_POST);
exit;*/
 if(isset($_POST['tipo'])):
 	$tipo=$_POST['tipo'];
 	///INSERTAMOS UN NUEVO PERSONA

 	$insertar=pg_query($conexion,"insert into tipocantidad(tipo) values ('$tipo')");

		if(!$insertar):
				$mensajeError='Error al insertar tipo';
	//BUSCAMOS EN ID DEL PERSONA QUE SE REGISTRO
		else:

								$mensajeError="tipo Registrada";
								$mensajeok=true;
    endif;

 	//
 					// INSERTAMOS NUEVO USUARIOS
else:
 		$mensajeError='Todos los datos son requeridos 2';

endif;
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);

?>
