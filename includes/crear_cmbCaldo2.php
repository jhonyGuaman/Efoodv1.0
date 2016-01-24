<?php
include_once('../conexion/db.php');
$valor=$_POST['idC'];
echo "<select class='form-control' id='cmb_caldo2'>";
echo "<option value=''>Seleccione</option>";
$consulta =pg_query($conexion,("Select * from platos where idtipo=1 and platos.id <>$valor"));
while($tipo=pg_fetch_array($consulta)){
echo "<option value='".$tipo[0]."'>". $tipo[1]."</option>";
 }
echo "</select>";
?>
