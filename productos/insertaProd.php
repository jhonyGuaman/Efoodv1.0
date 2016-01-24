<?php
include_once('../conexion/db.php');
$mensajeok=false;
$mensajeError='Error al Conectar a la Base de Datos';

if(isset($_POST['nombreP'],$_POST['precio'],$_POST['cantidad'],$_POST['precio_iva'])):
  $nombreP=$_POST['nombreP'];
  $precio=$_POST['precio'];
  $cantidad=$_POST['cantidad'];
  $categoria=$_POST['categoria'];
  $iva=$_POST['iva'];
  $precio_iva=$_POST['precio_iva'];
  $dias=$_POST['dias'];


  $insertar=pg_query($conexion,"insert into platos(nombreplato,idtipo,precio,cantidad,dias_disponibles) values 
    ('$nombreP','$categoria','$precio','$cantidad','$dias')");
      if(!$insertar):
        $mensajeError="Error a insertar los datos en la tabla platos";
      else:

        $getbyeId=pg_query($conexion,"select max(id) from platos");
              if(pg_num_rows($getbyeId)>0):
                $Plat=pg_fetch_array($getbyeId);
                $getid=$Plat[0];
                $insertar2=pg_query($conexion,"insert into productosind(idplato,iva,precioiva) values('$getid','$iva',$precio_iva)") ;
                $mensajeError="producto Registrado";
                $mensajeok=true;
              else:
                $mensajeError='plato no encontrado';
              endif;
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
