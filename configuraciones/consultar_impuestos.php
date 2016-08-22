  <?php
include_once('../conexion/db.php');
?>
<table id="tb_impuesto" class="table table-bordered table-hover dt-responsive">
  <thead>
    <tr>
      <th style="width: 10px">#</th>
      <th >Impuesto</th>
      <th>Valor</th>
      <th>Estado</th>
      <th style="width: 100px">Acciones</th>
    </tr>
  </thead>  
  <tbody>
    <?php
      $consulta =pg_query($conexion,("select * from impuestos order by id asc"));
      while($tipo=pg_fetch_array($consulta)){
        echo "    <tr>";
        echo "    <td>".$tipo['0']."</td>";
        echo "    <td>".$tipo['1']."</td>";
        echo "    <td>".$tipo['2']."</td>";
        if($tipo['3']=="activo"){
        echo "    <td><span class='label label-success'>".$tipo['3']."</span></td>"; 
        }else{
        echo "    <td><span class='label label-danger'>".$tipo['3']."</span></td>";   
        }
        echo "    <td> <div class='btn-group'>
                <button type='button' class='btn btn-default' data-toggle='modal' data-target='#modalimpuesto' onclick='actualizar_impuesto(".$tipo[0].")' ><i class='fa fa-pencil'>
                </i> Modificar</button>
                <button type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown'>
                    <span class='caret'></span>
                    <span class='sr-only'>Toggle Dropdown</span>
                </button>
                <ul class='dropdown-menu' role='menu'>
                <li><a href=javascript:eliminar_impuesto(".$tipo[0].");><i class='fa fa-trash-o'></i> Eliminar</a></li>
                </ul>
                </div> </td>";
        echo "  </tr>";
      }
    ?>
  </tbody>
</table>    
<script>
$(function () {
  $("#tb_impuesto").DataTable();
});
</script> 