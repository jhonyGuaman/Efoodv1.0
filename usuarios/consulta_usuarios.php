<?php
include_once('../conexion/db.php');
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-danger">
        <div class="panel-heading">Listado de productos</div>
    <table class='table table-bordered table-hover'>
      <tr>
        <th>ID</th>
        <th>FOTO</th>
        <th>USUARIO</th>
        <!-- <th>CLAVE</th> -->
        <th>NOMBRE</th>
        <th>CEDULA</th>
        <th>DIRECION</th>
        <th>TELEFONO</th>
        <th>OPCIONES</th>
      </tr>

      <?php
      $consulta =pg_query($conexion,("select * from view_usuarios order by id asc"));
      while($tipo=pg_fetch_array($consulta)){
        echo "  <tr>";
        echo " 		<td>".$tipo['0']."</td>";
        echo " 		<td> <img src='".$tipo['3']."' style='width: 45px' class='img-circle' alt='User Image'></td>";
        echo " 		<td>".$tipo['1']."</td>";
        // echo " 		<td>".md5($tipo['2'])."</td>";
        echo " 		<td>".$tipo['4']." ".$tipo['5']." ".$tipo['6']."</td>";
        echo " 		<td>".$tipo['7']."</td>";
        echo " 		<td>".$tipo['8']."</td>";
        echo " 		<td>".$tipo['9']."</td>";
        echo "   <td> <div class='btn-group'>
          <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalusuarios' onclick='actualizar_usuarios(".$tipo[0].")'><i class='fa fa-pencil'>
          </i> Modificar</button>
          <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
            <span class='caret'></span>
            <span class='sr-only'>Toggle Dropdown</span>
          </button>
          <ul class='dropdown-menu' role='menu'>
            <li><a href=eliminar_tipoCantidad(".$tipo[0].");><i class='fa fa-trash-o'></i> Eliminar</a></li>
          </ul>
        </div> </td>";
        echo "	</tr>";
      }
      ?>
    </table>
  </div>
</div>
</div>
</section>
