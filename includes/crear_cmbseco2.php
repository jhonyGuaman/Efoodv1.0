<?php
include_once('../conexion/db.php');
$valor=$_POST['idS'];
echo "<select class='form-control' id='cmb_seco2'>";
echo "<option value=''>Seleccione</option>";
$consulta =pg_query($conexion,("Select * from platos where idtipo=2 and platos.id <>$valor"));
while($tipo=pg_fetch_array($consulta)){
echo "<option value='".$tipo[0]."'>". $tipo[1]."</option>";
 }
echo "</select>";
?>
