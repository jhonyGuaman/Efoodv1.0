  <?php
include_once
('../conexion/db.php');
$valor=$_POST['idS'];
$mensajeok='';
$cmb="";
$c=0;

if($valor >= 101): 
    $sqlProductos = pg_query($conexion,("select productos.precio,productos.cantidad,productos.precio_iva from productos where id ='$valor'"));
    if(pg_num_rows($sqlProductos)>0):
        $mensajeok="iva";
        $Producto=pg_fetch_array($sqlProductos);
        $precio=$Producto[0];
        $cantidad=$Producto[1];
        $precio2=$Producto[2];
        $c++;
        $salidaJson=array('mensaje'=> $mensajeok, 'precio'=> $precio, 'cantidad' => $cantidad,'precio2'=>$precio2);
        echo json_encode($salidaJson);
      endif;
endif;

if($c==0):
$sql = pg_query($conexion,("select * from platos where idxcantidad=1 and id='$valor'")); // buscamos si el id es por 
if(pg_num_rows($sql)>0):                                                                 // presas y por platos
  $cmb .="<select class='form-control' id='cbm_presas'>";
  $cmb .="<option selected='selected'>Seleccione</option>";
  $cmb .="<option value='presa1'>Presa 1 </option>";
  $cmb .="<option value='presa2'>Presa 2 </option>";
  $cmb .="<option value='presa3'>Presa 3 </option>";
  $cmb .="<option value='presa4'>Presa 4 </option>";
  $cmb .="</select>";
  $Platos=pg_fetch_array($sql);
  $precio=$Platos[4];
  //echo $cmb;
  $salidaJson=array('mensaje'=> $mensajeok, 'cmb'=> $cmb,'precio'=> $precio);
  echo json_encode($salidaJson);
else:
  //$mensajeError='Fecha no se encuentra en la BD';
$sql1=pg_query($conexion,("select platos.precio,porplatos.cantidad from platos,porplatos where platos.id=porplatos.idplato and platos.id='$valor'"));
          if(pg_num_rows($sql1)>0):
            $mensajeok=true;
            $Platos=pg_fetch_array($sql1);
            $precio=$Platos[0];
            $cantidad=$Platos[1];
            $salidaJson=array('mensaje'=> $mensajeok, 'precio'=> $precio, 'cantidad' => $cantidad);
            echo json_encode($salidaJson);
          else:
            $sql2=pg_query($conexion,("select platos.precio,productosind.cantidad from platos,productosind where platos.id=productosind.idplato and platos.id='$valor'"));
            if(pg_num_rows($sql2)>0):
              $mensajeok=true;
              $Platos=pg_fetch_array($sql2);
              $precio=$Platos[0];
              $cantidad=$Platos[1];
              $salidaJson=array('mensaje'=> $mensajeok, 'precio'=> $precio,'cantidad' => $cantidad);
              echo json_encode($salidaJson);
            else:
                  $sql3=pg_query($conexion,("select platos.precio from platos where  platos.id='$valor'"));
                if(pg_num_rows($sql3)>0):
                  $mensajeok=true;
                  $Platos=pg_fetch_array($sql3);
                  $precio=$Platos[0];
                 /* $cantidad=$Platos[1];*/
                  $salidaJson=array('mensaje'=> $mensajeok, 'precio'=> $precio);
                  echo json_encode($salidaJson);
                  endif;
            endif;

          endif;

        endif;
endif;

?>
