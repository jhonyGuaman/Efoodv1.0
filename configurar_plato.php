<?php
include_once('conexion/db.php');
 ?>
 <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <script src="plugins/funciones/jsfunciones.js"></script>
 <script src="platos/control_platos.js"></script>

<style>
.text_total input{
  width: 80%;
  text-align: center;

}
.tablas input{
  border: 0;
  width: 15px;
}

.S_fecha input{
  border: 0;
  font-size: 13px;
}

@media (max-width: 645px){
.Textcantidad input{
  width: 25px;
  }
}
</style>

<script>
$(document).ready(function () {
  var hoy = new Date();
var dd = hoy.getDate();
var mm = hoy.getMonth()+1; //hoy es 0!
var yyyy = hoy.getFullYear();

if(dd<10) {
    dd='0'+dd
}

if(mm<10) {
    mm='0'+mm
}

hoy = mm+'/'+dd+'/'+yyyy;
//alert(hoy);
$("#fechaA").val(hoy);
});
// funcion para buscar si el el dia de hoy se ha configurado la cantidad de las presas
$(document).ready(function(){
    var fecha = $("#fechaA").val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'platos/segurar_config.php',
      data:{fecha:fecha},
      success:function(response){
        if(response.respuesta==true){
          $("#btn_guardar1").attr("disabled",true);
          alert("La canfidad de las presas ya ha sido configurado hoy");
          //$("#btn_guardar2").attr("disabled",true);
        }else{
        $("#btn_guardar1").attr("disabled",false);
        }
      }
    });
});// find
// funcion para verificar si se ha configurado la cantidad de platos
$(document).ready(function(){
    var fecha = $("#fechaA").val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'platos/segurar_config2.php',
      data:{fecha:fecha},
      success:function(response){
        if(response.respuesta==true){
          //$("#btn_guardar1").attr("disabled",true);
          $("#btn_guardar2").attr("disabled",true);
        }else{
        $("#btn_guardar2").attr("disabled",false);
        }
      }
    });
});

</script>

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
            <i class="fa fa-cutlery"></i>Configurar Plato
            <div class="pull-right S_fecha">
            <input type="text" id="fechaA" value="">
            </div>

            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Configurar Cantidad de los Platos

                </li>
                 <div class="pull-right">
            <?php
                      setlocale(LC_ALL,"es_ES");
                      $dias = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
                        echo strftime("<h5>Hola, hoy es ".$dias[date("w")]."</h5>");
                      ?>
          </div>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div  class="box box-danger" id="tab-presas">
                <div class="box-header with-border">
                  <h3 class="box-title">Configurar Por Presas</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i id="iconpresas" class="fa fa-minus"></i></button>
                    <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
                  </div>
                </div><!-- /.box-header -->
                      <?php
                        $dia=strftime($dias[date("w")]);
                        $d="";
                        if($dia=="domingo"){
                          $d="D";
                        }else if($dia == "lunes" || $dia =="martes" || $dia=="mi&eacute;rcoles"|| $dia=="jueves"|| $dia=="viernes"){
                          $d="L-V";
                        }else if($dia == "s&aacute;bado" || $dia == "domingo")
                        {
                          $d="S-D";
                        }
                     ?>
                <div class="box-body" id="body-presa">
                    <table class="table table-bordered" id="tabla1">
                    <tr>
                      <th>ID</th>
                      <th>Plato</th>
                      <th>Pechuga</th>
                      <th>Pernil</th>
                      <th>Ala</th>
                      <th>Muslo</th>
                      <th style="width: 40px">Total</th>
                    </tr>
                    <tr>
                      <?php
                      $consulta =pg_query($conexion,("Select platos.id,platos.nombreplato from platos,tipocantidad where platos.idxcantidad=tipocantidad.id and platos.idxcantidad=1 and platos.dias_disponibles ilike '%$d%'"));
                      if(pg_num_rows($consulta)>0){
                      $x=0;
                      while($tipo=pg_fetch_array($consulta)){
                        ?>
  <td class="tablas"><input type="text" name="idPresa<?php echo $x?>" id="idPresa<?php echo $x?>" value="<?php echo $tipo[0];?>"></td>
                      <td> <?php echo $tipo[1]; ?></td>
                      <td class="Textcantidad">
                        <input type="text" name="presa<?php echo $x?>1" id="presa<?php echo $x?>1" onkeyup="sumar(<?php echo $x?>);" size="10" maxlength="2"> </input>
                      </td>
                      <td class="Textcantidad">
                        <input type="text" name="presa<?php echo $x?>2" id="presa<?php echo $x?>2" onkeyup="sumar(<?php echo $x?>);" size="10" maxlength="2"> </input>
                      </td>
                      <td class="Textcantidad">
                        <input type="text" name="presa<?php echo $x?>3" id="presa<?php echo $x?>3" onkeyup="sumar(<?php echo $x?>);" size="10" maxlength="2"> </input>
                      </td>
                      <td class="Textcantidad">
                        <input type="text" name="presa<?php echo $x?>4" id="presa<?php echo $x?>4" onkeyup="sumar(<?php echo $x?>);" size="10" maxlength="2"> </input>
                      </td>
                      <td class="text_total"><input type="text" name="total<?php echo $x?>" id="total<?php echo $x?>" disabled value="0"></input> </td>
                    </tr>
                    <?php $x++; }
                       }else{ ?>
                          <script type="text/javascript">
                          $("#tab-presas").addClass("collapsed-box");
                          $("#iconpresas").removeClass("fa fa-minus").addClass("fa fa-plus");
                          $("#body-presa").css("display","none");
                          </script>
                       
<?php                      }// fin del if ?>
                     
                  </table>
                     <br>
                  <div class="row">
                  </div>
                      <div class="col-lg-10"></div>
                        <div class="col-lg-2 col-xs-4">
                          <button type="button" id="btn_guardar1" class="btn btn-danger  btn-lg btn-block">Guardar</button>
                        </div>

                 </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  </div><!-- /.box-footer -->
              </div><!-- /.box -->


   <div class="box box-danger" id="tab-platos">
                <div class="box-header with-border">
                  <h3 class="box-title">Configurar Por Platos</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i id="iconplatos" class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                    <?php
                        $dia=strftime($dias[date("w")]);
                        $d="";
                        if($dia=="domingo"){
                          $d="D";
                        }else if($dia == "lunes" || $dia =="martes" || $dia=="mi&eacute;rcoles"|| $dia=="jueves"|| $dia=="viernes"){
                          $d="L-V";
                        }else if($dia == "s&aacute;bado" || $dia == "domingo")
                        {
                          $d="S-D";
                        }
                     ?>
                <div class="box-body" id="body-platos">
                  <table class="table table-bordered" id="tabla2">
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th>Nombre del Plato</th>
                    <th>Cantidad de Platos</th>
                  </tr>
                  <tr>
                    <?php
                    $consulta =pg_query($conexion,("Select platos.id,platos.nombreplato from platos,tipocantidad where platos.idxcantidad=tipocantidad.id and platos.idxcantidad=2 and platos.dias_disponibles ilike '%$d%'"));
                      if(pg_num_rows($consulta)>0){
                    
                    $x=0;
                    while($tipo=pg_fetch_array($consulta)){
                    ?>
                    <td class="tablas"> <input type="text" name="idPlato<?php echo $x?>" id="idPlato<?php echo $x?>" value="<?php echo $tipo[0];?>" ></td>
                    <td> <?php echo $tipo[1]; ?></td>
                    <td>
                      <input type="text" name="cantidadP<?php echo $x?>" id="cantidadP<?php echo $x?>" size="10" maxlength="2"> </input>
                    </td>
                  </tr>
                   <?php $x++; } 
                    }else{
                ?>
                      <script type="text/javascript">
                          $("#tab-platos").addClass("collapsed-box");
                          $("#iconplatos").removeClass("fa fa-minus").addClass("fa fa-plus");
                          $("#body-platos").css("display","none");
                          </script>
                       
<?php                      }// fin del if ?>
                     
                </table>
                <div class="row">
                </div>
                    <div class="col-lg-10"></div>
                      <div class="col-lg-2">
                        <button type="button" id="btn_guardar2" class="btn btn-danger  btn-lg btn-block">Guardar </button>
                      </div>

                 </div><!-- /.box-body -->
                <div class="box-footer text-center">
                  </div><!-- /.box-footer -->
              </div><!-- /.box -->

</div>

 </div>
