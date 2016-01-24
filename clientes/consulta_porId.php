<?php
include_once('../conexion/db.php');
$valor =$_POST['valor'];
?>
<div class="row">
    <div class="col-md-10">
          <table class='table'>
      <tr>
        <td>ID</td>
        <td>CLIENTE</td>
        <td>CEDULA</td>
        <td>DIRECION</td>
        <td>TELEFONO</td>
        <td>OPCIONES</td>
      </tr>

      <?php
      $consulta =pg_query($conexion,("select * from view_clientes where nombre ilike'%".$valor."%' or cedula ilike'%".$valor."%'; "));
      while($tipo=pg_fetch_array($consulta)){
        echo "  <tr>";
        //echo " 		<td>".$tipo['0']."</td>";
        echo " 		<td>".$tipo['1']."</td>";
        echo " 		<td>".$tipo['2']." ".$tipo['3']."</td>";
        echo " 		<td>".$tipo['5']."</td>";
        echo " 		<td>".$tipo['6']."</td>";
        echo " 		<td>".$tipo['7']."</td>";
         echo "   <td> <div class='btn-group'>
          <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalclientes' onclick='actualizar_clientes(".$tipo[0].")'><i class='fa fa-pencil'>
          </i> Modificar</button>
          <button type='button' class='btn btn-info dropdown-toggle' data-toggle='dropdown'>
            <span class='caret'></span>
            <span class='sr-only'>Toggle Dropdown</span>
          </button>
          <ul class='dropdown-menu' role='menu'>
            <li><a href=javascript:eliminar_cliente(".$tipo[0].");><i class='fa fa-trash-o'></i> Eliminar</a></li>
          </ul>
        </div> </td>";
        echo "	</tr>";
      }
      ?>
    </table>
  </div>
</div>
