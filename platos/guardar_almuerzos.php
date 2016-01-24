<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';

if(isset($_POST['caldo1'],$_POST['caldo2'],$_POST['seco1'],$_POST['seco2'],$_POST['fecha'])):
  $caldo1=$_POST['caldo1'];
  $caldo2=$_POST['caldo2'];
  $seco1=$_POST['seco1'];
  $seco2=$_POST['seco2'];
  $fecha=$_POST['fecha'];

  $insertar=pg_query($conexion,"insert into menu(caldo1,caldo2,seco1,seco2,fecha) values ('$caldo1','$caldo2','$seco1','$seco2','$fecha')");
      if(!$insertar):
        $mensajeError="Error a insertar los datos en la tabla menu del dia ";
      else:
        $mensajeError="El Plato Registrado  Correctamente.";
        $mensajeok=true;

      endif;

else:
  $mensajeError='Varible vacias reintente nuevamente';

endif;
$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);

?>
