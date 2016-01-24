<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';
if(isset($_POST['id'],$_POST['cantidad'],$_POST['fecha'])):
  $id=$_POST['id'];
  $cantidad=$_POST['cantidad'];
  $fecha=$_POST['fecha'];

$consulta =pg_query($conexion,("UPDATE platos SET cantidad='$cantidad'WHERE id=$id"));
$sql=pg_query($conexion,("UPDATE porplatos SET fecha='$fecha' WHERE idplato=$id"));
$mensajeError="Datos almacenados correctamente.";
$mensajeok=true;
/*  $insertar=pg_query($conexion,"insert into porplatos(cantidad,idplato,fecha) values ('$cantidad','$id','$fecha')");
      if(!$insertar):
        $mensajeError="Error a insertar los datos en la tabla platos";
      else:
        $mensajeError="El Plato Registrado  Correctamente.";
        $mensajeok=true;

      endif;
*/
else:
  $mensajeError='Todos los datos son necesarios por favor.';

endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
