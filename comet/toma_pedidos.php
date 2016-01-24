<?php
session_start();
require_once __DIR__ . 'bd_config.php';
set_time_limit(0);
function connectDB(){
    $conexion = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD ,DB_DATABASE);
	if(!$conexion){echo 'Ha sucedido un error inexperado en la conexion de la base de datos';}
	return $conexion;
}
function disconnectDB($conexion){
	$close = mysqli_close($conexion);
	if(!$close){echo 'Ha sucedido un error inexperado en la desconexion de la base de datos';}
	return $close;
}
$conexion = connectDB();
$ruc =  $_SESSION['ruc'];$_SESSION['ruc'] = $ruc;
$fecha_ac = isset($_GET['time']) ? $_GET['time']:0;$ro="";
$fecha_bd = $fecha_ac;

while( $fecha_bd <= $fecha_ac )
	{
    usleep(10000);
    clearstatcache();
		$query3    = "SELECT * FROM pedidos where id_sucur = '$ruc' and estado = 0 ORDER BY id DESC LIMIT 1";
		$con       = mysqli_query($conexion,$query3 );
		$ro        = mysqli_fetch_array($con);
		$fecha_bd  = strtotime($ro['fecha']);
	}
$array= array(); $array[0]=count($ro);$array[1]=$fecha_bd;
echo json_encode($array);
flush();
 	/*	$sql = "SELECT * FROM pedidos,subpedi where pedidos.ruc = '$ruc' and pedidos.estado = 0 and pedidos.id = subpedi.id_pedido ORDER BY pedidos.id asc ";
        $myArray = getArraySQL($sql);$n = count($myArray);
        $add = (string)$n."*<li class='header'>Usted tiene ".$n." pedidos</li><li><ul class='menu'>";
        for ($i=0; $i < $n ; $i++) {
        	$ide = $myArray[$i]['id'];
        	$add.= "<li id='".$ide."' onclick='pedidos_ver(this)'>
                        <a href='#'>
                          <i class='fa fa-shopping-cart text-green'></i> Nuevo PEDIDO Total de productos: <strong>".$n."</strong>
                          <span>".$myArray[$i]["fecha"]."</span>
                        </a>
                      </li>";
        }
        $add.="</ul></li>";
        echo $add;*/
?>
