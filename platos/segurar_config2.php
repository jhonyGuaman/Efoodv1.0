<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';
if(isset($_POST['fecha'])):

  $fecha=$_POST['fecha'];


  $sql=pg_query($conexion,"select * from porplatos where porplatos.fecha='$fecha'");
  if(pg_num_rows($sql)>0):
    $mensajeok=true;
    $mensajeError="Se encontro el registro en la base de datos";
  else:
    $mensajeError='Fecha no se encuentra en la BD';

  endif;

else:
  $mensajeError='Todos los datos son necesarios por favor.';

endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
