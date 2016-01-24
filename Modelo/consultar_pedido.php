<?php
include_once('../conexion/db.php');

$id=$_POST['id'];
$numeroM='vacio';
$estado="vacio";
if(isset($id)){

  $sql=pg_query($conexion,"Select pedido.id,mesa.numero_mesa, mesa.estado from pedido,mesa where pedido.idmesa=mesa.id and mesa.estado=$id");
  if(pg_num_rows($sql)>0){
    //$mensajeok=true;
    $pedido=pg_fetch_array($sql);
    $idpedido=$pedido[0];
    $numeroM=$pedido[1];
    $estado=$pedido[2];
    
  }else{

  }
  $salidaJson=array('idp'=>$idpedido,'mesa'=> $numeroM, 'estado' => $estado);
  echo json_encode($salidaJson);

}
?>
