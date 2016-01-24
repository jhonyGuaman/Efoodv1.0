<?php
include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
 if(isset($_POST['categoria'])):
 	$categoria=$_POST['categoria'];
 	///INSERTAMOS UN NUEVO PERSONA
 	$insertar=pg_query($conexion,"insert into tipoplato(categoria) values ('$categoria')");
		if(!$insertar):
				$mensajeError='Error al insertar Categoria';
		else:
				$mensajeError="Categoria Registrada";
				$mensajeok=true;
    endif;
else:
 		$mensajeError='Todos los datos son requeridos 2';
endif;
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);
?>
