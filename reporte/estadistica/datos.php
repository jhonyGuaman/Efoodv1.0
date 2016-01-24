<?php
include_once('../../conexion/db.php');
$platos=[];
$cantidad=[];
$con=1;
$consulta =pg_query($conexion,("select platos.nombreplato,porplatos.cantidad from platos,porplatos where platos.id=porplatos.idplato" ));
while($tipo=pg_fetch_array($consulta)){
  $platos[$con]="'".$tipo[0]."'";
  $cantidad[$con]="'".$tipo[1]."'";
  $con++;
}

$resul=array('platos'=>$platos,'cantidad'=>$cantidad,'sizes'=>$con);
echo json_encode($resul);
?>
