<style>
.alinearC{
  margin-left: 25%;
}
</style>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-male"></i>
        Registrar Clientes
      </h1>
      <ol class="breadcrumb">
        <li class="active">
          <i class="fa fa-male"></i> Nuevos Clientes
        </li>
      </ol>
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">

      <div class="alert alert-info alert-dismissable desvanecer" id="mensajeC" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-info-circle"> <strong> El Cliente se Registro Correctamente </strong></i>
      </div>
      <div class="alert alert-info alert-warning desvanecer" id="errorC" >
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="fa fa-info-circle"> <strong> Error al Registrar el Cliente Correctamente </strong></i>
      </div>
    </div>
  </div>

  <div class="row alinearC">
    <div class="col-md-8">
      <div class="panel panel-primary ">  <!--PANEL PRIMARIO -->
        <div class="panel-heading">
          <div class="panel-title"><h3>Ingresar Nuevos Clientes</h3></div>
      </div>
        <div class="panel-body">  						<!-- PANEL SECUNDARIO -->
          <div class="form-group">
            <label for="cedula">Cedula: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" name="cedu" id="cedula"  placeholder="Ingrese su Cedula" autofocus required size="10" maxlength="10" onkeyPress="return solo_numeros(event)">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre">Nombres: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="nombre"
              placeholder="Ingrese sus Nombres"  onKeyPress="return solo_letras(event)">
            </div>
          </div>
          <div class="form-group">
            <label for="ape_paterno">Apellido Paterno: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="ape_paterno"
              placeholder="Ingrese el Apellido Paterno"  onKeyPress="return solo_letras(event)">
            </div>
          </div>
          <div class="form-group">
            <label for="ape_materno">Apellido Materno: </label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="ape_materno"
              placeholder="Ingrese el Apellido Materno"  onKeyPress="return solo_letras(event)">
            </div>
          </div>
        <div class="form-group">
            <label for="direccion">Dirección: </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                </div>
                <textarea rows="3" class="form-control" id="direccion"
              placeholder="Ingrese la Dirección "> </textarea>
              </div>
        </div>

          <div class="form-group">
            <label>Telefono:</label>
            <div class="input-group">
              <div class="input-group-addon">
                <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
              </div>
              <input type="text" class="form-control" id="telefono" data-inputmask='"mask":"(999) 999-9999"' data-mask>
            </div>
          </div>

        </div>	<!--FIN DEL PANEL SECUNDARIO -->
      </div>			<!-- FIN DEL PANEL PRIMARIO -->
      <div class="col-md-4"></div>
      <button type="button" id="btn_cancelar" class="btn btn-danger">Cancelar <i class="fa fa-ban"></i></button>
      <button type="button" id="gcliente" class="btn btn-primary"> Guardar <i class="fa fa-floppy-o "></i> </button>

    </div>
  </div>

</div> <!-- fin del separador de la columan 8 -->

<div class="col-md-2"></div>
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="Controlador/control_cliente.js"></script>
<script type="text/javascript">
$(function () {
  //Initialize Select2 Elements
  $(".select2").select2();

  //Datemask dd/mm/yyyy
  $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
  //Datemask2 mm/dd/yyyy
  $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
  //Money Euro
  $("[data-mask]").inputmask();


});
</script>
