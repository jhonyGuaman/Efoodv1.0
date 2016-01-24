<?php
include_once('../../conexion/db.php');
$valor =$_POST['valor'];
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-danger">
        <div class="panel-heading">Listado de productos</div>
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Dias Disponibles</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $consulta =pg_query($conexion,("select * from view_productosind where nombreplato ilike'%".$valor."%'order by id asc"));
            while($tipo=pg_fetch_array($consulta)){
              echo "  <tr>";
              echo "    <td>".$tipo['0']."</td>";
              echo "    <td>".$tipo['1']."</td>";
              echo "    <td>".$tipo['2']."</td>";
              echo "    <td>".$tipo['3']."</td>";
              echo "    <td>".$tipo['4']."</td>";
              echo "   <td> <div class='btn-group'>
          <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalplatos' onclick='actualizar_producto(".$tipo[0].")'><i class='fa fa-pencil'>
          </i> Modificar</button>
          <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
            <span class='caret'></span>
            <span class='sr-only'>Toggle Dropdown</span>
          </button>
          <ul class='dropdown-menu' role='menu'>
            <li><a href=javascript:eliminar_producto(".$tipo[0].");><i class='fa fa-trash-o'></i> Eliminar</a></li>
          </ul>
        </div> </td>";
              echo "  </tr>";
            }
            ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </section>
