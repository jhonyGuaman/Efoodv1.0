<!-- LIBRERIAS JS -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<script src="Controlador/control_usuario.js"></script>

  <!--FIN DE LIBRERIAS -->
<style>
.boton{
  height:30px;
  width:90px;
}
</style>
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-cutlery"></i>
        Administración de Usuarios
      </h1>
    </div>
  </div>
  <div class="row form-horizontal">
    <div class="panel panel-default">
      <div class="panel-heading"><i class="fa fa-dashboard"></i> Administración de Usuarios</div>
      <div class="panel-body">
        <div class="form-group">
          <div class="col-xs-4  text-right">
                <label for="buscar" class="control-label">Buscar:</label>
          </div>
          <div class="col-xs-4">
            <div class="input-group input-group-sm">
              <input type="text"name="buscar" id="buscar" class="form-control" onkeyup="lista_usuarios(this.value);" placeholder="Ingrese Nombre o Nombre de Usuario">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary"> <i class="fa fa-search"></i></button>
                <button type="button" class="btn btn-primary" onclick="cargar_usuarios();"> <i class="fa fa-list-alt"></i></button>
              </div><!-- /btn-group -->
            </div><!-- /input-group -->
          </div>  <!-- fin de col-xs-4 -->
        </div>  <!-- fin de form-group-->
      </div> <!-- fin de panel-body-->
    </div><!-- fin de  panel panel-default -->

    <div id="lista_usuarios">
    </div>

    <!-- FORMULARIO PARA MODIFICAR EMPLEADO -->

    <div class="modal fade" id="modalusuarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h2 class="modal-title">Datos del Usuario</h2>
          </div>
          <div class="modal-body">
            <div class="alert alert-success text-center" id="exito" style="display:none;">
              <span class="glyphicon glyphicon-ok"> </span><span> Datos del usuarios se actualizado</span>
            </div>
            <form class="form-horizontal" id="formUsuario">
              <div class="form-group">
                <label for="isbn" class="control-label col-xs-5">ID :</label>
                <div class="col-xs-5">
                  <input  type="hidden" id="idP" name="idP"/>
                  <input id="idU" name="idU" type="text" class="form-control" placeholder="Ingrese Codigo" disabled="false">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Nombre :</label>
                <div class="col-xs-5">
                  <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Ingrese su Nombre">
                </div>
              </div>
              <div class="form-group">
                <label for="autor" class="control-label col-xs-5">Apellido Pat. :</label>
                <div class="col-xs-5">
                  <input id="apePat" name="apePat"  type="text" class="form-control" placeholder="Ingrese Apellido Paterno">
                </div>
              </div>
              <div class="form-group">
                <label for="añop" class="control-label col-xs-5">Apellido Mat.:</label>
                <div class="col-xs-5">
                  <input id="apeMat" name="apeMat" type="text" class="form-control" placeholder="Ingrese Apellido Materno">
                </div>
              </div>
              <div class="form-group">
                <label for="nrop" class="control-label col-xs-5">Cedula:</label>
                <div class="col-xs-5">
                  <input id="cedula" name="cedula" type="text" class="form-control" placeholder="Ingrese la Cedula">
                </div>
              </div>
              <div class="form-group">
                <label for="ediccion" class="control-label col-xs-5">Direción:</label>
                <div class="col-xs-5">
                  <input id="direcion" name="direcion" type="text" class="form-control" placeholder="Ingrese la Dirección">
                </div>
              </div>
              <div class="form-group">
                <label for="idioma" class="control-label col-xs-5">Telefono:</label>
                <div class="col-xs-5">
                  <input id="telefono" name="telefono" type="text" class="form-control" placeholder="Ingrese el Telefono">
                </div>
              </div>
              <div class="form-group">
                <label for="clave" class="control-label col-xs-5">Clave:</label>
                <div class="col-xs-5">
                  <input id="clave" name="clave" type="password" class="form-control" placeholder="Ingrese la clave">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="update_usuarios();">Guardar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--FIN DEL FORMULARIO PARA MODIFICAR EMPLEADO -->
  </div> <!--FIN DE ROW FORM-HORIZONTAL -->
</div>
