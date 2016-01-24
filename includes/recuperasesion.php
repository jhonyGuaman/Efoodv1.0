<?php  
 include_once('../conexion/db.php');
 $mensajeok=false;
 $mensajeError='Error al Conectar a la Base de Datos';
if(isset($_POST['Contrasena'])):
 				if($_POST['Contrasena']!=" "):
 					$Contrasena=$_POST['clave'];

 					$consulta=pg_query($conexion,("Select * from usuarios where clave='$Contrasena'"));
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
 		$mensajeError='Todos los datos son requeridos';
 endif;

 $salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
 echo json_encode($salidaJson);

?>