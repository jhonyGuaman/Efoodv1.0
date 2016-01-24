<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';
if(isset($_POST['nombreplato'],$_POST['precio'])):
  $nombreplato=$_POST['nombreplato'];
  $precio=$_POST['precio'];
  $idtipo=$_POST['idtipo'];
  $idxcantidad=$_POST['idxcantidad'];
  $dias=$_POST['dias'];
    $insertar=pg_query($conexion,"insert into platos(nombreplato,precio,idtipo,idxcantidad,dias_disponibles) values ('$nombreplato','$precio','$idtipo','$idxcantidad','$dias')");
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
