  $(document).ready(function(){
    $("#cedula").focusout(function(){
      if($("#cedula").val()=="" || $("#cedula").val().length <10){
          new PNotify({title: 'Error',text: 'Campo cedula esta incompleto o vacio',type: 'error',delay: 2000});
          $("#cedula").focus();
        }else{
          buscar_cedulaCliente();
          }
  });
});

$("#cedula").keypress(function(tecla) {
  if(tecla.which == 13){
    if($("#cedula").val()==""){
      new PNotify({title: 'Error',text: 'Campo cedula esta incompleto o vacio',type: 'error',delay: 2000});
    }else{
      buscar_cedulaCliente();
    }
  }
});


function buscar_cedulaCliente(){
  var cedula=$("#cedula").val();
  //alert(cedula);
  $.ajax({
    type:"POST",
    dataType:"json",
    url:'clientes/buscar_cliente.php',
    data:{cedula:cedula},
    success:function(response){
      if(response.respuesta==true){
        new PNotify({title: 'Error',text: response.mensaje ,type: 'error',delay: 2000});
        $("#cedula").focus();
      }else{

      }
    }
  });
}


$(document).ready(function(){
  $("#gcliente").click(function(){
    var cedula=$('#cedula').val();
    var nombre=$('#nombre').val();
    var apellidopat=$('#ape_paterno').val();
    var apellidomat=$('#ape_materno').val();
    var telefono=$('#telefono').val();
    var direcion=$('#direccion').val();
    if(cedula=="" || nombre=="" || apellidopat=="" || apellidomat=="" || telefono=="" || direcion ==""){
      new PNotify({title: 'Error',text: 'Por favor ingrese los campos faltantes',type: 'error',delay: 2000});
        if(cedula==""){
          $("#cedula").focus();
        }else if(nombre==""){
          $("#nombre").focus();
        }else if(apellidopat==""){
          $('#ape_paterno').focus();
        }else if(apellidomat==""){
            $('#ape_materno').focus();
        }else if(telefono==""){
          $('#telefono').focus();
        }else if(direcion==""){
          $('#direccion').focus();
        }
      }
      else{
        $.ajax({
          type:"POST",
          dataType:"json",
          url:'includes/clienteAjax.php',
          data:{cedula:cedula,nombre:nombre,apellidopat:apellidopat,apellidomat:apellidomat,telefono:telefono,direcion:direcion},
          success:function(response){
            if(response.respuesta==true){
              $('#mensajeC').fadeIn(3000);
              $('#mensajeC').fadeOut(6000);
              limpiarClientes();
            }else if(response.respuesta==false)
            {
              $("#errorC").fadeIn(3000);
              $("#errorC").fadeOut(5000);
            }
          }
        });
      }
  });
});



    ///FUNCIONES PARA ACTULIZAR MOSTRAR Y ELIMINAR CLIENTES

    function cargar_clientes(){
      $('#lista_clientes').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");
      $.ajax({
        url:'clientes/consulta_clientes.php',
        success:function(response){
          setTimeout(function(){
            $('#lista_clientes').html(response);
          },2000);

        }
      });
    }
    function lista_cliente(valor){

      $('#lista_clientes').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");

      if(valor=="")
      {
        $('#lista_clientes').html("No se encontraron resultados...");
      }else{
        $('#lista_clientes').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");
        $.ajax({
          url:'clientes/consulta_porId.php',
          type:'POST',
          data:{valor:valor},
          success:function(response){
            setTimeout(function(){
              $('#lista_clientes').html(response);
            },2000);

          }
        });
      }
    }

    function actualizar_clientes(id){
      //divResultado = document.getElementById('lista1');
      $.ajax({
        url:'clientes/consultar_porId2.php',
        type:'POST',
        dataType:"json",
        data:{id:id},
        success:function(response){
          $('#idclien').val(response.Pid);
          $('#idclient').val(response.Cid);
          $('#nombre').val(response.Cnombre);
          $('#apePat').val(response.CapeP);
          $('#apeMat').val(response.CapeM);
          $('#cedula').val(response.Ccedula);
          $('#direcion').val(response.Cdirecion);
          $('#telefono').val(response.Ctelefono);

        }
      });
    }


    function update_cliente(){
      //var $id2=$('#id_update').val();
      //var $categoria=$('#categoria_update').val();
      var datosform=$("#formcliente").serialize();
      $.ajax({
        url:'clientes/update_clientes.php',
        type:'POST',
        data:datosform,
        success:function(response){
          $('#exito').show();
          $('#lista_clientes').html(response);
        }
      });
    }

    function eliminar_cliente(id){
      divResultado = document.getElementById('lista_clientes');
      var opcionEliminar= confirm("Esta seguro Eliminar el Cliente");
      if (opcionEliminar)
      {
        $.ajax({
          url:'clientes/delete_clientes.php',
          type:'POST',
          data:{id:id},
          success:function(response){
            //alert("Tipo ha sido elimindado correcto");
            $('#lista_clientes').html(response);
            //divResultado.innerHTML = ajax.responseText
          }
        });
      }
    }