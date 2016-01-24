<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';
if(isset($_POST['id'],$_POST['presa1'],$_POST['presa2'],$_POST['presa3'],$_POST['presa4'])):
  $id=$_POST['id'];
  $presa1=$_POST['presa1'];
  $presa2=$_POST['presa2'];
  $presa3=$_POST['presa3'];
  $presa4=$_POST['presa4'];
  $fecha=$_POST['fecha'];

  $insertar=pg_query($conexion,"insert into presas(presa1,presa2,presa3,presa4,idplato,fecha) values ('$presa1','$presa2','$presa3','$presa4','$id','$fecha')");
      if(!$insertar):
        $mensajeError="Error a insertar los datos en la tabla platos";
      else:
        $mensajeError="El Plato Registrado  Correctamente.";
        $mensajeok=true;

      endif;

else:
  $mensajeError='Todos los datos son necesarios por favor.';

endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);
?>
