<?php
 include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
if(isset($_POST['Usuario'],$_POST['Contrasena'])):
 		if($_POST['Usuario'] !=" "):
 				if($_POST['Contrasena']!=" "):
 					$Usuario=$_POST['Usuario'];
 					$Contrasena=$_POST['Contrasena'];

 					$consulta=pg_query($conexion,("Select * from usuarios where username='$Usuario' and clave='$Contrasena' and tipo='admin'"));
 					if(pg_num_rows($consulta)>0):
 						$mensajeok=true;
 						$Usua=pg_fetch_array($consulta);
 						session_start();
 						$_SESSION['id']=$Usua[0];
 						$_SESSION['Usuario']=$Usua[2];
 						$mensajeError="logueo Correcto";
 					else:
 						$mensajeError='Usuario o Contrasena Incrorrecto';

 					endif;

 				else:
 					$mensajeError='Contraseña Incrorrecta.';
 				endif;
 		else:
 				$mensajeError='Usuario no existe.';
 		endif;
 	else:
 		$mensajeError='Todos los datos son requeridos';
 endif;

 $salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);

?>
