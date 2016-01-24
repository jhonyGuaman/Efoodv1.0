<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';

if(isset($_POST['nombreP'],$_POST['precio'],$_POST['cantidad'],$_POST['precio_iva'],$_POST['precio_iva'])):
  $nombreP=$_POST['nombreP'];
  $precio=$_POST['precio'];
  $cantidad=$_POST['cantidad'];
  $iva=$_POST['iva'];
  $precio_iva=$_POST['precio_iva'];

  $insertar=pg_query($conexion,"insert into productos(nombreproducto,precio,cantidad,iva,precio_iva) values 
    ('$nombreP','$precio','$cantidad','$iva','$precio_iva')");
      if(!$insertar):
        $mensajeError="Error a insertar los datos en la tabla producto";
      else:
        $mensajeError="El Producto Registrado  Correctamente.";
        $mensajeok=true;

      endif;

else:
  echo "llene todos los campos";
  $mensajeError='Todos los datos son necesarios por favor.';

endif;

$salidaJson=array('respuesta'=> $mensajeok, 'mensaje' => $mensajeError);
echo json_encode($salidaJson);

?>
