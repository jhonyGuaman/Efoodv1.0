<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';
  $mesa=$_POST['mesa'];
  $insertar=pg_query($conexion,"insert into mesa(numero_mesa,estado) values ('$mesa',0)");
      if(!$insertar){
        $mensajeError="Error a insertar los datos en la tabla mesas";
      }else{
        $mensajeError="La mesa se Registrado  Correctamente.";
        $mensajeok=true;

      }

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
