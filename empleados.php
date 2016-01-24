<style>
.direc{
padding-top: 125px;

}
.boton{
  padding-top: 2px;
  padding-left: 7%
}
.contenedor{
  width: 200px;
  height: 200px;
  margin-top: 22%;
  padding-left: 2%;
  padding-right: 0%;
}
.desvanecer1{
  display: none;
}
.desvanecer2{
  display: none;
}
.alinearC{
  margin-left: 5%;
  margin-right: 5%;
}
</style>

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<script src="Controlador/control_usuario.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("#cedula").focus();
});
$(function(){
  $("input[name='file']").on("change",function(){
    var formData = new FormData($("#form1")[0]);
    var ruta = "subirfoto/imagen-ajax.php";
    $("#respuesta").html("<center><img src='dist/img/load_usuario.gif'   height='100' width='100'> </center>");
    $.ajax({
      url: ruta,
      type:"POST",
      data: formData,
      contentType: false,
      processData: false,
      beforeSend: function(){
        $('.desvanecer1').css('display','inline');
      },
      success: function(datos)
      {
        setTimeout(function(){
          $('#respuesta').fadeIn(2000);
          $("#respuesta").html(datos);
        },2000);

      }
    });
  });
});

$(function(){
  $("#cancelar").on("click",function(){
    var archivo =$('#archivo').val();
    $("#respuesta").html("<center>   <img src='dist/img/load_usuario.gif'   height='100' width='100'> </center>");
    $.ajax({
      url: 'subirfoto/eliminar_archivo.php',
      type: 'POST',
      timeout: 10000,
      data: {archivo: archivo},
      error: function() {
        mostrarRespuesta('Error al intentar eliminar el archivo.', false);
      },
      beforeSend: function(){
        // $('.desvanecer2').css('display','inline');
        $('.desvanecer1').css('display','inline');
      },
      success: function(respuesta) {
        if (respuesta == 1) {
          setTimeout(function(){
            $('#file').val('');
            $('#archivo').val('');
            //mostrarRespuesta('La Foto ha sido Removida.', true);
            $("#respuesta").html("La Foto ha sido Removida.");
            $('.desvanecer1').hide();
          },2000);
        }
        else
        {
          //mostrarRespuesta('Error al intentar eliminar el archivo.', false);
          $("#respuesta").html("Error al intentar eliminar el archivo.");
        }
      }
    });
  });
});


$(document).ready(function(){
  $("#subir").on("click",function(){
    var archivo =$('#archivo').val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'includes/subirfoto/guardar.php',
      data: {archivo: archivo},
      success:function(response){
        if(response.respuesta==true)
        {
          alert("Usuario Registrado Correctamente");
          $('#file').val('');
          $('#archivo').val('');
          $('#respuesta').fadeOut(2000);
        }else
        {
          $("#respuesta").html(response.mensaje)
        }
      }

    });
  });
});

function mostrarRespuesta(mensaje, ok){
  $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
  if(ok){
    $("#respuesta").addClass('alert-success');
  }else{
    $("#respuesta").addClass('alert-danger');
  }
}

</script>
<div class="container-fluid">
  <div clas="row">
    <div class="col-lg-12">
      <h1 class="page-header">
        <i class="fa fa-user"></i>
        Registrar Usuarios
      </h1>
      
    </div>
  </div><!-- /.row -->

  <div class="row alinearC">
    <div class="col-md-12" >
      <div class="panel panel-danger ">  <!--PANEL PRIMARIO -->
        <div class="panel-heading">
          <div class="panel-title"><h3>Ingresar Nuevo Usuario</h3></div>
        </div>
        <div class="panel-body">                         <!-- PANEL SECUNDARIO -->
                   <div class="col-md-4">
                  <label for="cedula">Cedula: </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
                    </div>
                    <input type="text" class="form-control" id="cedula" onKeyDown=" return precionar_tab(event);" placeholder="Ingrese su Cedula" autofocus required size="10" maxlength="10" onkeypress="return solo_numeros(event)">
                  </div>
                  </div>
                   <div class="col-md-4">
                                  <label for="nombre">Nombres: </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese sus Nombres"  onKeyPress="return solo_letras(event)">
                  </div>

                </div>
                   <div class="col-md-4">
                
                  <label for="ape_paterno">Apellido Paterno: </label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                    </div>
                    <input type="text" class="form-control" id="ape_paterno"
                    placeholder="Ingrese el Apellido Paterno"  onKeyPress="return solo_letras(event)"></th>
                  </div>
                </div>
                   <div class="col-md-4">
                
                  <td> <label for="ape_materno">Apellido Materno: </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      </div>
                      <input type="text" class="form-control" id="ape_materno"
                      placeholder="Ingrese el Apellido Materno"  onKeyPress="return solo_letras(event)">
                    </div>
                  </div>
                   <div class="col-md-4">
                  <label for="nombre">Nombres Usuario: </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                      </div>
                      <input type="text" class="form-control" id="usuario"
                      placeholder="Ingrese sus Nombres"  onKeyPress="return solo_letras(event)">
                    </div>
                  </div>
                   <div class="col-md-4">
                  <label for="clave">Contraseña: </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
                      </div>
                      <input type="password" class="form-control" id="clave"  placeholder="Contraseña">
                    </div>
                  </div>
                   <div class="col-md-4">
                  <label>Telefono:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
                        </div>
                        <input type="text" class="form-control" id="telefono" data-inputmask='"mask":"(999) 999-9999"' data-mask>
                      </div>
                    </div>
                   <div class="col-md-4">
                    <label for="tipo_plato">Tipo Usuario: </label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>
                        </div>
                        <select class="form-control" id="tipo">
                          <option value="admin">Administrador</option>
                          <option value="mesero">Mesero</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <label for="ejemplo_archivo_1">Subir Foto:</label>
                      <form  method="post" id="form1" enctype="multipart/form-data">
                        <input type="file" id="file" name="file">
                      </form>
                      <p class="help-block">Ejemplo de texto de ayuda.</p>
                    </div>
                    <div id="respuesta" class="contenedor">
                    </div>
                    <div class="row">
                      <div class="boton col-md-4">
                    <i class="fa fa-refresh fa-spin desvanecer2"></i> <button type="button" id="cancelar" class="btn btn-danger desvanecer1">CANCELAR</button>
                      </div>
                    </div>
                      

            

            <div class=" direc col-md-8">     
            <div class="form-group">
              <label for="direccion">Dirección: </label>
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                </div>
                <textarea rows="3" class="form-control" id="direcion"
                placeholder="Ingrese la Dirección "> </textarea>
              </div>
            </div>
          </div>
          </div>  <!--FIN DEL PANEL SECUNDARIO -->
        </div>            <!-- FIN DEL PANEL PRIMARIO -->
        <button type="button" id="gempleado"class="btn btn-danger"> Guardar <i class="fa fa-floppy-o "></i></button>
        <!--</form> FIN DEL FORMULARIO -->
      </div>
    </div>
  </div> <!-- fin de container-fluid-->
  <!-- Select2 -->
  <script src="plugins/select2/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="plugins/input-mask/jquery.inputmask.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
  <script>
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
