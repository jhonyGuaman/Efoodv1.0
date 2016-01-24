<!-- LIBRERIAS JS -->
<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="plugins/funciones/jsfunciones.js"></script>
<!--FIN DE LIBRERIAS -->

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
            <div class="input-group margin">
              <input type="text"name="buscar" id="buscar" class="form-control" onkeyup="lista_libros(this.value);" placeholder="Ingrese Nombre o Cedula">
              <div class="input-group-btn">
                <button type="button" class="btn btn-primary" data-toggle='modal' data-target='#modallibros'> <i class="fa fa-search"></i></button>
              </div><!-- /btn-group -->
            </div><!-- /input-group -->
          </div>
          <div class="form-group">
            <div id="lista_usuarios">
            </div>
          </div>

        </div>

      </div>
    </div>

    <!-- FORMULARIO PARA MODIFICAR EMPLEADO -->

    <div class="modal fade" id="modallibros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h2 class="modal-title">Datos del Libro</h2>
          </div>
          <div class="modal-body">
            <div class="alert alert-success text-center" id="exito" style="display:none;">
              <span class="glyphicon glyphicon-ok"> </span><span> Su cuenta ha sido registrada</span>
            </div>
            <form class="form-horizontal" id="formLibro">
              <div class="form-group">
                <label for="isbn" class="control-label col-xs-5">ISBN :</label>
                <div class="col-xs-5">
                  <input  type="hidden" id="idlib" name="idlib"/>
                  <input id="isbn" name="isbn" type="text" class="form-control" placeholder="Ingrese ISBN">
                </div>
              </div>
              <div class="form-group">
                <label for="titulo" class="control-label col-xs-5">Titulo :</label>
                <div class="col-xs-5">
                  <input id="titulo" name="titulo" type="text" class="form-control" placeholder="Ingrese Titulo">
                </div>
              </div>
              <div class="form-group">
                <label for="autor" class="control-label col-xs-5">Autor :</label>
                <div class="col-xs-5">
                  <input id="autor" name="autor"  type="text" class="form-control" placeholder="Ingrese Autor">
                </div>
              </div>
              <div class="form-group">
                <label for="añop" class="control-label col-xs-5">Año de Publicacion:</label>
                <div class="col-xs-5">
                  <input id="añop" name="añop" type="text" class="form-control" placeholder="Ingrese Año de Publicacion">
                </div>
              </div>
              <div class="form-group">
                <label for="nrop" class="control-label col-xs-5">Nro. de Paginas:</label>
                <div class="col-xs-5">
                  <input id="nrop" name="nrop" type="text" class="form-control" placeholder="Ingrese su Email">
                </div>
              </div>
              <div class="form-group">
                <label for="ediccion" class="control-label col-xs-5">Ediccion:</label>
                <div class="col-xs-5">
                  <input id="ediccion" name="ediccion" type="text" class="form-control" placeholder="Ingrese Ediccion">
                </div>
              </div>
              <div class="form-group">
                <label for="idioma" class="control-label col-xs-5">Idioma:</label>
                <div class="col-xs-5">
                  <input id="idioma" name="idioma" type="text" class="form-control" placeholder="Ingrese Ediccion">
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="guardar();">Guardar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!--FIN DEL FORMULARIO PARA MODIFICAR EMPLEADO -->
  </div> <!--FIN DE ROW FORM-HORIZONTAL -->
