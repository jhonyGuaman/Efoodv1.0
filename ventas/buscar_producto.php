<?php
include_once('../conexion/db.php');


$bus=$_POST['bus'];
$rawdata = array();
$i=0;
$sql =pg_query($conexion,("select platos.nombreplato from platos where platos.nombreplato ilike '%$bus%'"));
//$myArray = getArraySQL($sql);
while($row = pg_fetch_array($sql)){
        $rawdata[$i] = $row;
        $i++;
}
echo json_encode($rawdata);
 ?>
