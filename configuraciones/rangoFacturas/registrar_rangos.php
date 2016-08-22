<?php
include_once('../../conexion/db.php');
$mensajeok		=false;
$mensajeError	='Error al Conectar a la Base de Datos';
$ruc 			=$_POST['ruc'];
$desde			=$_POST['desde'];
$hasta 			=$_POST['hasta'];

  $insertar=pg_query($conexion,"insert into rangosruc(ruc,desde,hasta) values ('$ruc',$desde,'$hasta')");
      if(!$insertar){
        $mensajeError="Error a insertar los datos en la tabla rangos RUC";
      }else{
        $mensajeError="La Rango Registrado  Correctamente.";
        $mensajeok=true;

      }

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
