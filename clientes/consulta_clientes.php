<?php
include_once('../conexion/db.php');
?>
<div class='box box-danger'>
  <div class='box-header with-border'>
    <h3 class='box-title'>Clientes</h3>
    <div class='box-tools pull-right'>
      <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
    </div>
  </div>
  <div class='box-body' style="display: block;">
    <table id="tblacliente" class='table table-bordered table-hover'>
      <thead>
      <tr>
        <th>ID</th>
        <th>CLIENTE</th>
        <th>CEDULA</th>
        <th>DIRECION</th>
        <th>TELEFONO</th>
        <th>OPCIONES</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $consulta =pg_query($conexion,("select * from view_clientes order by id asc"));
      while($tipo=pg_fetch_array($consulta)){
        echo "  <tr>";
        echo " 		<td>".$tipo['1']."</td>";
        echo "    <td>".$tipo['2']." ".$tipo['3']."</td>";
        echo "    <td>".$tipo['5']."</td>";
        echo "    <td>".$tipo['6']."</td>";
        echo "    <td>".$tipo['7']."</td>";
        echo "   <td> <div class='btn-group'>
          <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalclientes' onclick='actualizar_clientes(".$tipo[0].")'><i class='fa fa-pencil'>
          </i> Modificar</button>
          <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
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
    </tbody>
    </table>
  </div>
</div>
