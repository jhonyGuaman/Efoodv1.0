<?php
include_once('../../conexion/db.php');
?>
<table id="tb_rangos" class="table table-bordered table-hover dt-responsive">
  <thead>
    <tr>
      <th style="width: 10px">#</th>
      <th style="width: 150px">Ruc</th>
      <th>Desde</th>
      <th>Hasta</th>
      <th style="width: 200px">Acciones</th>
    </tr>
  </thead>  
  <tbody>
    <?php
      $consulta =pg_query($conexion,("select * from rangosRuc order by id asc"));
      while($tipo=pg_fetch_array($consulta)){
        echo "    <tr>";
        echo "    <td>".$tipo['0']."</td>";
        echo "    <td>".$tipo['1']."</td>";
        if($tipo['2']<=9){
        echo "    <td>00000000".$tipo['2']."</td>";
        }else if($tipo['2']<=99){
        echo "    <td>0000000".$tipo['2']."</td>";
        }else if($tipo['2']<=999){
        echo "    <td>000000".$tipo['2']."</td>";
        }else if($tipo['2']<=9999){
        echo "    <td>00000".$tipo['2']."</td>";
        }

        if($tipo['3']<=9){
        echo "    <td>00000000".$tipo['3']."</td>";   
        }else if($tipo['3']<=99){
        echo "    <td>0000000".$tipo['3']."</td>";     
        }else if($tipo['3']<=999){
        echo "    <td>000000".$tipo['3']."</td>";     
        }else if($tipo['3']<=9999){
        echo "    <td>00000".$tipo['3']."</td>";     
        }
        echo "    <td> <div class='btn-group'>
                <button type='button' class='btn btn-default' data-toggle='modal' data-target='#Modal_actualizarRango' onclick='actualizar_rango(".$tipo[0].")' ><i class='fa fa-pencil'>
                </i> Modificar</button>
                <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
                    <span class='caret'></span>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <ul class='dropdown-menu' role='menu'>
                <li><a onclick='calcular_rango(".$tipo[0].")' data-toggle='modal' data-target='#Modal_actualizarRango'><i class='fa fa-trash-o'></i>Calcular siguente Rango</a></li>
                <li><a onclick='elimniar_numero(".$tipo[0].")' data-toggle='modal' data-target='#Modal_eliminar_Factura'><i class='fa fa-trash-o'></i> Eliminar # de Factura</a></li>
                <li><a href=javascript:eliminar_rango(".$tipo[0].");><i class='fa fa-trash-o'></i> Eliminar</a></li>

                </ul>
                </div> </td>";
        echo "  </tr>";
      }
    ?>
  </tbody>
</table>    
<script>
$(function () {
  $("#tb_rangos").DataTable();
});
</script> 