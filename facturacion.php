<?php
include_once('conexion/db.php');
 ?>

<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="ventas/control_ventas.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="plugins/select2/select2.full.min.js"></script>

<style>

.precio input{
    text-align: center;
    border: 0;
    width: 40px;
}

.fila input{
  text-align: center;
  width: 50px;
}
.fila_total input{
  border: 0;
  text-align: center;
  width: 40px;
}
.filas input{
  border: 0;
  text-align: center;
}
.aceptado_Cliente{
  margin-top: 5px;
  margin-right: 5px;
  color: blue;
}
.negar_cliente{
  margin-top: 5px;
  color: red;

}
.margen{
  margin-top: 25px;
}

.margen select{
  border-radius: 10px;
}
.btn_add {
  margin-top: 25px;
}
.nfactura input{
text-align: center;
border: 0;
width: 60%;
}
.alinear_der{
margin-left: 30px;

}
.alinear_dere input{
  width: auto;
background: #f39c12;
text-decoration-color: #111;
text-align: right;
border: 0;
width:90%;
}
.alinear_der input{
  text-align: right;
  border: 0;
  width: 50%;
}
.ValorP{
  margin-top: 10px;
  border-radius: 7px;
  background: #f39c12;
  padding: 1em;
  font-family: sans-serif;
  box-shadow:  0px 5px 5px rgba(0, 0, 0, 0.5);

}
.Panel_producto{
  border-radius: 1em;
  padding: 1em;
}
.total{
  background-color: #333;
  padding: 1em;
  border-radius: 10px;
  text-align: center;
  margin: 1em auto;
  margin-bottom: 15px;
  margin-top: 15px;
}

.total input{
  font-size: 34px;
  font-family: "Square721 BT";
  background: #333;
  border: 0;
  width: 60%;
  color: #00d347;
  padding: 0.5em;
  margin-top: 10px;
  text-align: center;
}
.boton_limpirar{
  align-content:center;
}
.color_rojo{
  color: red;
}

.centrar_input{
  margin-left: 70px;
}
th{
  color:blue;
}
</style>
<div class="container-fluid"> <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        Facturación
        <div class="pull-right box-tools">
          <button class="btn btn-danger  btn-sm" id="btn_generar" ><i class="fa fa-share-square-o "></i> Generar Pedido</button>
        </div><!-- /. tools -->
      </h1>
    </div>
  </div><!-- /.row -->
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Registro de Pedidos</h3>
          <div class="pull-right">
            <?php
                      setlocale(LC_ALL,"es_ES");
                      $dias = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
                        echo strftime("<h4>Hola, hoy es ".$dias[date("w")]."</h4>");
                      ?>
          </div>
      </div><!-- /.box-header -->
      <div class="col-md-7">
        <div class="Panel_producto">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Productos</h3>
            </div>
            <div class="panel-body">
              <div class="col-md-8">
                <div class="row">
                <div class='col-md-6'>
                    <div class="form-group">
                      <label>Plato:</label>
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
                      <select id="cmb_producto" class="form-control select2" style="width: 100%;">
                        <option selected="selected">Seleccione</option>
                        <?php
                        $consulta = pg_query($conexion,("Select id,nombreplato from platos where dias_disponibles ilike '%$d%'"));
                        while($tipo=pg_fetch_array($consulta)){
                        ?>
                        <option value="<?php echo $tipo[0];?>" ><?php  echo $tipo[1] ?></option>
                       <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div id="Npresas" class="col-md-6 margen">
                  </div>
                </div> <!--FIN DEL ROW -->
              </div>
            </br>
            <div class="row">
              <div class='col-sm-1 col-md-2 col-lg-3'></div>
              <div id='div_noti' class='col-xs-12 col-sm-10 col-md-8 col-lg-6'></div>
            </div>
            <div class="col-md-6">
              <label for="cedula">Precio: </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                </div>
                <input type="text" class="form-control" id="precio" placeholder="Costo del Plato" disabled="false">
              </div>
            </div>
            <div class="col-md-4">
              <label for="cantidad">Cantidad: </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                </div>
                <input type="text" class="form-control" id="cantidad" placeholder="Stock" disabled="false">
              </div>
            </div>
            <div class="col-md-2 btn_add">
              <button class="btn btn-success btn-sm" id="btn_agregar" onclick="fn_agregar();" ><span class="glyphicon glyphicon-saved" aria-hidden="true"></span></i></button>
            </div>
          </div>
        </div>
      </div> <!--fin del panel producto -->
      <div class="panel panel-default">
        <div class="panel-body">
          <div>
            <table class="table table-bordered table-hover" id="tabla_detalle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Cantidad</th>
                  <th>Descripción</th>
                  <th>Precio unit.</th>
                  <th>Total</th>
                  <th>     </th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div> <!--fin del panel para la tabla-->
      <div class="row">
        <div class="col-md-4 ">
        </div>
        <div class="col-md-4 boton_limpirar">
          <button class="btn btn-info btn-sm" id="btn_limpirar" ><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Limpiar Pedido</button>
        </div>
        <div class="col-md-4 filas">
          Numeros de Productos:<input type="text" name="nfilas" id="span_cantidad"> </input>
        </div>
      </div>
    </div> <!--fin del col-md-7-->
    <div class="col-md-5">
      <div class="total">
        <input type="text" name="total_p" id="total_p" value="$0.00">
      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="nFactura" class="text-center">
            <label for="numero">Numero de Factura: </label>
            <div class="nfactura">
              <input type="text" class="form-control centrar_input"  id="nfacturas" placeholder="0000001" disabled="false">
            </div>
          </div>
        </div>
      </div> <!--fin del panel para el numero de Factura-->
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="nFactura">
            <label for="numero">Cedula del cliente: </label>
            <div class="input-group input-group-sm">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control"  id="cedula_buscar" placeholder="Ingrese el numero de Cedula" size="10" maxlength="10">
              <span class="input-group-btn">
                <button type="button" class="btn btn-danger"> <i class="fa fa-search"></i></button>
                <button type="button" class="btn btn-danger" data-toggle='modal' data-target='#modalR_Clientes'> <i class="fa fa-user-plus"></i></button>
              </span><!-- /btn-group -->
            </div>
            <div id="aceptar" class="aceptado_Cliente">
            </div>
            <div id="negar" class="negar_cliente">
            </div>
          </div>
        </div>
      </div> <!--fin del panel para el cliente-->
      <div class="panel panel-default">
        <div class="panel-body">
          <div id="subTotal">
                <div class="row">
                      <div class="col-md-3">
                        Sub-Total:
                      </div>
                      <div class="col-md-8 alinear_der">
                    <input type="text" class="form-control"  id="subtotal" placeholder="$ 0,00" >
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-3">
                        Iva 12%:
                      </div>
                      <div class="col-md-8 alinear_der">
                    <input type="text" class="form-control"  id="iva12" placeholder="$ 0,00" >
                      </div>
                </div>
                <div class="row">
                      <div class="col-md-3">
                        Iva 0%:
                      </div>
                      <div class="col-md-8 alinear_der">
                    <input type="text" class="form-control"  id="iva0" placeholder="$ 0,00" >
                      </div>
                </div>
            </div> <!-- fin del div subtotal -->
            <div id="totalP" class="ValorP">
              <div class="row">
                    <div class="col-md-4">
                      Total a Pagar:
                    </div>
                    <div class="col-md-6 alinear_dere">
                  <input type="text" class="form-control"  id="totalp" placeholder="$ 0,00" >
                    </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!--fin del panel para el Total a pagar-->
    </div>
  </div><!-- /.box -->
</div>


<!-- FORMULARIO PARA REGISTRAR CLIENTES-->

<div class=" modal modal-primary fade" id="modalR_Clientes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2 class="modal-title">Registro de Cliente</h2>
      </div>
      <div class="modal-body">
        <div class="alert alert-success text-center" id="exito" style="display:none;">
          <span class="glyphicon glyphicon-ok"> </span><span> Cliente Registrado Correctamente...</span>
        </div>
        <form class="form-horizontal" id="formcliente">
          <div class="form-group">
            <label for="cedula" class="control-label col-xs-5">Cedula: </label>
            <div class="col-xs-5">
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" name="cedu" id="cedula" placeholder="Ingrese su Cedula" autofocus required size="10" maxlength="10" onkeyPress="return solo_numeros(event)">
            </div>
            </div>
          </div>

          <div class="form-group">
            <label for="nombre" class="control-label col-xs-5">Nombres: </label>
            <div class="col-xs-5">
            <div class="input-group ">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="nombre"
              placeholder="Ingrese sus Nombres"  onKeyPress="return solo_letras(event)">
            </div>
          </div>
          </div>

          <div class="form-group">
            <label for="ape_paterno" class="control-label col-xs-5">Apellido Paterno: </label>
            <div class="col-xs-5">
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="ape_paterno"
              placeholder="Ingrese el Apellido Paterno"  onKeyPress="return solo_letras(event)">
            </div>
          </div>
          </div>

          <div class="form-group">
            <label for="ape_materno" class="control-label col-xs-5">Apellido Materno: </label>
            <div class="col-xs-5">
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="ape_materno"
              placeholder="Ingrese el Apellido Materno"  onKeyPress="return solo_letras(event)">
            </div>
          </div>
          </div>

          <div class="form-group">
            <label for="direccion" class="control-label col-xs-5">Dirección: </label>
            <div class="col-xs-5">
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
              </div>
              <textarea rows="3" class="form-control" id="direccion"
              placeholder="Ingrese la Dirección "> </textarea>
            </div>
          </div>
          </div>

          <div class="form-group">

            <label class="control-label col-xs-5">Telefono:</label>
            <div class="col-xs-5">
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="telefono" data-inputmask='"mask":"(999) 999-9999"' data-mask>
            </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="gcliente" >Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--FIN DEL FORMULARIO PARA MODIFICAR PLATOS-->

<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
