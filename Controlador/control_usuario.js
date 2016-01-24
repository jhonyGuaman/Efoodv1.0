$(document).ready(function(){
  $('#usuario').val("");
  $('#clave').val("");

});

function precionar_tab( event ){
  var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
  if (keyCode == 9)
  {
    if($("#cedula").val()==""){
       new PNotify({title: 'Error',text: 'El campo cedula se encuenta vacio',type: 'error',delay: 2000});
      $("#cedula").focus();
    }else{
      buscar_cedulaUsuario();
      return true;
    }
  }
}

$("#cedula").keypress(function(tecla) {

  if(tecla.which == 13){
    if($("#cedula").val()==""){
       new PNotify({title: 'Error',text: 'El campo cedula se encuenta vacio',type: 'error',delay: 2000});
     
    }else{
      buscar_cedulaUsuario();
    }
  }
});


function buscar_cedulaUsuario(){
  var cedula=$("#cedula").val();
  //alert(cedula);
  $.ajax({
    type:"POST",
    dataType:"json",
    url:'usuarios/buscar_usuario.php',
    data:{cedula:cedula},
    success:function(response){
      if(response.respuesta==true){
        //$('#mensaje').fadeIn(3000);
       // alert(response.mensaje);
         new PNotify({title: 'Error',text: 'El usuario '+response.mensaje+' ya se encuentra registrado',type: 'error',delay: 2000});
         $('#cedula').focus();
      }
    }
  });
}




$("#gempleado").click(function(){
  if($("#cedula").val()=="" ){
  alert("Por Favor ingrese la cedula del Usuario");
  }else if( $("#nombre").val()==""){
  alert("Por Favor ingrese el nombre del usuario");
  }else if($('#ape_paterno').val()==""){
  alert("Por Favor ingrese el Apellido Paterno");
  }else if($("usuario").val()==""){
  alert("Por Favor ingrese el Nombre de Usuario");
  }else{
  registrar_usuario();
  }
});

function registrar_usuario(){
    var cedula=$('#cedula').val();
    var nombre=$('#nombre').val();
    var apellidopat=$('#ape_paterno').val();
    var apellidomat=$('#ape_materno').val();
    var usuario=$('#usuario').val();
    var telefono=$('#telefono').val();
    var clave =$('#clave').val();
    var foto=$('#archivo').val();
    var direcion=$('#direcion').val();
    var tipo=$("#tipo").val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'includes/usuarioAjax.php',
      data:{cedula:cedula,nombre:nombre,apellidopat:apellidopat,apellidomat:apellidomat,usuario:usuario,telefono:telefono,clave:clave,foto:foto,direcion:direcion,tipo:tipo},
      success:function(response){
        if(response.respuesta==true){
          $('#mensaje').fadeIn(3000);
          alert("Usuario Registrado Correctamente");
        }else
        {
          $("#mensaje").html(response.mensaje)
        }
      }
    });
  }

  //////////////////////////////////////
  // FUNCIONES PARA ACTUALIZAR MOSTRAR Y ELIMNIAR USUARIOS
  function cargar_usuarios(){
    $('#lista_usuarios').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");
    $.ajax({
      url:'usuarios/consulta_usuarios.php',
      success:function(response){
        setTimeout(function(){
          $('#lista_usuarios').html(response);
        },2000);

      }
    });
  }

  function lista_usuarios(valor){

    $('#lista_usuarios').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");

    if(valor ==" ")
    {
      $('#lista_usuarios').html("No se encontraron resultados...");
    }else{
      $('#lista_usuarios').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");
      $.ajax({
        url:'usuarios/consulta_porId.php',
        type:'POST',
        data:{valor:valor},
        success:function(response){
          setTimeout(function(){
            $('#lista_usuarios').html(response);
          },2000);

        }
      });
    }
  }

  function actualizar_usuarios(id){
    //divResultado = document.getElementById('lista1');
    $.ajax({
      url:'usuarios/consultar_porId2.php',
      type:'POST',
      dataType:"json",
      data:{id:id},
      success:function(response){
        $('#idP').val(response.Uid);
        $('#idU').val(response.Uid);
        $('#nombre').val(response.Unombre);
        $('#apePat').val(response.UapeP);
        $('#apeMat').val(response.UapeM);
        $('#cedula').val(response.Ucedula);
        $('#direcion').val(response.Udirecion);
        $('#telefono').val(response.Utelefono);
        $('#clave').val(response.Uclave)

      }
    });
  }


  function update_usuarios(){
    var datosform=$("#formUsuario").serialize();
    $.ajax({
      url:'usuarios/update_usuarios.php',
      type:'POST',
      data:datosform,
      success:function(response){
        $('#exito').show();
        $('#lista_usuarios').html(response);
      }
    });
  }

  function eliminar_usuario(id){
    divResultado = document.getElementById('lista_usuarios');
    var opcionEliminar= confirm("Esta seguro Eliminar el Usuario");
    if (opcionEliminar)
    {
      $.ajax({
        url:'usuarios/delete_usuario.php',
        type:'POST',
        data:{id:id},
        success:function(response){
          //alert("Tipo ha sido elimindado correcto");
          $('#lista_usuarios').html(response);
          //divResultado.innerHTML = ajax.responseText
        }
      });
    }
  }

  //////////////////////
