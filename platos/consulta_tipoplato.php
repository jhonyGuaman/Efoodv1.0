<?php
include_once('../conexion/db.php');
?>
<div class='box box-danger'>
  <div class='box-header with-border'>
    <h3 class='box-title'>Tipo Platos</h3>
    <div class='box-tools pull-right'>
      <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
    </div>
  </div>
  <div class='box-body'>
    <table class='table'>
      <tr>
        <th>ID</th>
        <th>TIPO PLATO</th>
        <th>OPCIONES</th>
      </tr>
      <?php
      $consulta =pg_query($conexion,("select * from tipoplato order by id asc"));
      while($tipo=pg_fetch_array($consulta)){
        echo "<tr>";
        echo " 		<td>".$tipo['0']."</td>";
        echo " 		<td>".$tipo['1']."</td>";
        echo "<td><div class='btn-group'>
                  <button type='button' class='btn btn-default btn-flat' data-toggle='modal' data-target='#modalplato' onclick='actualizar(".$tipo[0].")'><i class='fa fa-pencil'>
                  </i> Modificar</button>
                  <button type='button' class='btn btn-info btn-flat dropdown-toggle' data-toggle='dropdown'>
                  <span class='caret'></span>
                  <span class='sr-only'>Toggle Dropdown</span>
                  </button>
                  <ul class='dropdown-menu' role='menu'>
                  <li><a href=javascript:eliminar(".$tipo[0].");><i class='fa fa-trash-o'></i>Eliminar</a></li>
                  </ul>
                  </div>
             </td>";
        //echo " 		<td><button type='button' class='btn btn-success boton' data-toggle='modal' data-target='#modalplato' onclick='actualizar(".$tipo[0].")'><i class='fa fa-pencil-square-o'></i>Modificar</button><br>";
        //echo "   <button type='button' class='btn btn-danger boton' onclick='eliminar(".$tipo[0].")'><i class='fa fa-trash-o'></i>Eliminar</button></td> ";
        echo "	</tr>";
      }
      ?>
    </table>
  </div>
</div>
