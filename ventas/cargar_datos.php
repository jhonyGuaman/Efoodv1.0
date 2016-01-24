<?php
include_once('../conexion/db.php');
$valor=$_POST['valor'];
$id =$_POST['id'];
$mensajeok=false;
//$cmb="";
  if($valor=="presa1"):
    $sql = pg_query($conexion,("select presa1 from presas,platos where platos.id=presas.idplato and presas.idplato='$id'"));
    if(pg_num_rows($sql)>0):
        $presa1=pg_fetch_array($sql);
        $cantidad=$presa1[0];
      $mensajeok=true;
      $salidaJson=array('mensaje'=> $mensajeok, 'cantidad'=> $cantidad);
      echo json_encode($salidaJson);
    endif;
  elseif($valor=="presa2"):
    $sql1 = pg_query($conexion,("select presa2 from presas,platos where platos.id=presas.idplato and presas.idplato='$id'"));
    if(pg_num_rows($sql1)>0):
        $presa2=pg_fetch_array($sql1);
        $cantidad=$presa2[0];
        $mensajeok=true;
        $salidaJson=array('mensaje'=> $mensajeok, 'cantidad'=> $cantidad);
        echo json_encode($salidaJson);
    endif;
    elseif($valor=="presa3"):
      $sql2 = pg_query($conexion,("select presa3 from presas,platos where platos.id=presas.idplato and presas.idplato='$id'"));
      if(pg_num_rows($sql2)>0):
          $presa3=pg_fetch_array($sql2);
          $cantidad=$presa3[0];
          $mensajeok=true;
          $salidaJson=array('mensaje'=> $mensajeok, 'cantidad'=> $cantidad);
          echo json_encode($salidaJson);
      endif;
      elseif($valor=="presa4"):
        $sql3 = pg_query($conexion,("select presa4 from presas,platos where platos.id=presas.idplato and presas.idplato='$id'"));
        if(pg_num_rows($sql3)>0):
            $presa4=pg_fetch_array($sql3);
            $cantidad=$presa4[0];
            $mensajeok=true;
            $salidaJson=array('mensaje'=> $mensajeok, 'cantidad'=> $cantidad);
            echo json_encode($salidaJson);
        endif;
endif;

?>
