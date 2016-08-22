<?php
include_once('../conexion/db.php');
$mensajeok		=false;
$mensajeError	='Error al Conectar a la Base de Datos';
$impuesto 		=$_POST['impuesto'];
$valor			=$_POST['valor'];
$estado 		=$_POST['estado'];

  $insertar=pg_query($conexion,"insert into impuestos(impuesto,valor,estado) values ('$impuesto',$valor,'$estado')");
      if(!$insertar){
        $mensajeError="Error a insertar los datos en la tabla mesas";
      }else{
        $mensajeError="La Impuesto Registrado  Correctamente.";
        $mensajeok=true;

      }

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
