
//funcion para ingresar productos nuevo
$(document).ready(function(){
  $("#btn_producto2").click(function(){
     if ($("#nombreP").val()== "") {
      new PNotify({title: 'Error',text: 'El campo nombre del Producto esta vacio',type: 'error',delay: 2000});
      $("#nombreP").focus();
    }else if ($("#precio").val()=="") {
      new PNotify({title: 'Error',text: 'El campo Precio esta vacio',type: 'error',delay: 2000});
      $("#precio").focus();
    }else if ($("#cantidad").val()=="") {
      new PNotify({title: 'Error',text: 'El campo Precio esta vacio',type: 'error',delay: 2000});
      $("#cantidad").focus();
    }
    else{
      var nombreP=$("#nombreP").val();
      var precio=$("#precio").val();
      var categoria =$("#idtipo").val();
      var cantidad=$("#cantidad").val();
      var iva=$("input:radio[name=iva]:checked").val();
      var precio_iva=$("#precio_iva").val();
      var dias=$("#dias").val();
      //alert(iva);
      //var iva12=$("#precio_iva").val();
      $.ajax({
        type:"POST",
        dataType:"json",
        url:'productos/insertaProd.php',
        data:{nombreP:nombreP,precio:precio,cantidad:cantidad,categoria:categoria,iva:iva,precio_iva:precio_iva,dias:dias},
        success:function(response){
          if(response.respuesta==true){
            $('#mensaje').fadeIn(3000);
            alert("Producto Registrado Correctamente");
            $("#nombreP").val("");
            $("#precio").val("");
            $('#cantidad').val("");
            $('#iva').val("");
            $('#precio_iva').val("");
          }else
          {
            $("#mensaje").html(response.mensaje)
          }
        }

      });
    }});
  });

$(document).ready(function(){
  $("#nombreP").focus();
  $("#nombreP").focusout(function(){
    if($("#nombreP").val()==""){
        $("#nombreP").focus();
    }else{
    validar_existencia_producto();
  }
  });
});

//FUNCIONES PARA INGRESAR PRODUCTOS INDUSTRIALIZADOS
$(document).ready(function(){
  $("#btn_producto").click(function(){
     if ($("#nombreP").val()== "") {
      new PNotify({title: 'Error',text: 'El campo nombre del Producto esta vacio',type: 'error',delay: 2000});
      $("#nombreP").focus();
    }else if ($("#precio").val()=="") {
      new PNotify({title: 'Error',text: 'El campo Precio esta vacio',type: 'error',delay: 2000});
      $("#precio").focus();
    }else if ($("#cantidad").val()=="") {
      new PNotify({title: 'Error',text: 'El campo Precio esta vacio',type: 'error',delay: 2000});
      $("#cantidad").focus();
    }
    else{
      var nombreP=$("#nombreP").val();
      var precio=$("#precio").val();
      var cantidad=$("#cantidad").val();
      var categoria=$("#idtipo").val();
      var dias=$("#dias").val();
      //alert(iva);
      //var iva12=$("#precio_iva").val();
      $.ajax({
        type:"POST",
        dataType:"json",
        url:'bebidas/insertar_bebidas.php',
        data:{nombreP:nombreP,precio:precio,cantidad:cantidad,idtipo:categoria,dias:dias},
        success:function(response){
          if(response.respuesta==true){
            $('#mensaje').fadeIn(3000);
            new PNotify({title: 'Ingreso de Bebida',text: 'Bebida registrada correctamente',type: 'success',delay: 2000});
            
            $("#nombreP").val("");
            $("#precio").val("");
            $('#cantidad').val("");
            
          }else
          {
            $("#mensaje").html(response.mensaje)
          }
        }

      });
    }});
  });


function validar_existencia_producto(){
var producto=$('#nombreP').val();
$.ajax({
  type:"POST",
  dataType:"json",
  url:'Modelo/buscar_producto.php',
  data:{producto:producto},
  success:function(response){
    if(response.respuesta==true){
      new PNotify({title: 'Error',text: 'El producto '+response.mensaje+' ya se encuentra almacenado',type: 'error',delay: 2000});
      $('#nombreP').focus();
    }
  }
});
}

function lista_productos(valor){
  $('#lista_productos').html("<img style='margin-left: 10cm' src='dist/img/platos.gif'> ");
  if(valor=="")
  {
  $('#lista_productos').html("No se encontraron resultados...");
  }else{
    $('#lista_productos').html("<img style='margin-left: 10cm' src='dist/img/platos.gif'> ");
    $.ajax({
      url:'productos/adminProductos/consulta_productosxid.php',
      type:'POST',
      data:{valor:valor},
      success:function(response){
        setTimeout(function(){
          $('#lista_productos').html(response);
        },1000);

      }
    });
  }
}




function actualizar_producto(id){
  $.ajax({
    url:'productos/adminProductos/consultar_productosxid2.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idproducto').val(response.Pid);
      $('#idproductos').val(response.Pid);
      $('#nombre_producto').val(response.Pnombre);
      $('#precio').val(response.Pprecio);
      $('#cantidad').val(response.Pcantidad);
      $('#precio_iva').val(response.Pprecioiva);

      if(response.Piva=='12%'){
        alert("producto con iva 12 %");
        $('#iva12').prop("checked", true);
      }else {
        alert("producto con iva 0 %");
        $('#iva0').prop("checked", true);
      }
      $('#idtipo').val(response.Pcategoria);
      $('#dias').val(response.Pdias);


    }
  });
}

function update_producto(){
  var id=$('#idproducto').val();
  var nombre=$('#nombre_producto').val();
  var precio=  $('#precio').val();
  var cantidad=$('#cantidad').val();
  var dias=$('#dias').val();
  var idtipo=$('#idtipo').val();
  var precio_iva=$('#precio_iva').val();

  var iva=$('input:radio[name=iva]:checked').val();
  alert("iva "+iva);
    $.ajax({
    url:'productos/adminProductos/update_productos.php',
    type:'POST',
    data:{id:id,nombre:nombre,precio:precio,cantidad:cantidad,iva:iva,dias:dias,idtipo:idtipo,precio_iva:precio_iva},
    success:function(response){
      $('#exito').show();
      $('#lista_productos').html(response);
    }
  });
}

function eliminar_producto(id){
  divResultado = document.getElementById('lista_productos');
  var opcionEliminar= confirm("Esta seguro Eliminar el producto");
  if (opcionEliminar)
  {
    $.ajax({
      url:'productos/adminProductos/delete_productos.php',
      type:'POST',
      data:{id:id},
      success:function(response){
        //alert("Tipo ha sido elimindado correcto");
        $('#lista_productos').html(response);
        //divResultado.innerHTML = ajax.responseText
      }
    });
  }
}
  //FUNCIION DEL IVA 12 %
  $(document).ready(function(){
    $("#iva12").click(function(){
      if($("#precio").val()==""){
        new PNotify({title: 'Error',text: 'Ingrese el precio del producto',type: 'error',delay: 2000});
        $("#iva12").prop("checked", false)
        $("#precio").focus();

      } else {
        var precio= $("#precio").val();
        var precio_total=precio -(precio * 0.12);
        alert(precio_total);
        $("#precio_iva").val(precio_total);}
      });
    });

  // FUNCION DEL IVA 0
    $(document).ready(function(){
      $("#iva0").click(function(){
        if($("#precio").val()==""){
          new PNotify({title: 'Error',text: 'Ingrese el precio del producto',type: 'error',delay: 2000});
          $("#iva0").prop("checked", false)
          $("#precio").focus();
        }
        else{
          var precio= $("#precio").val();
          alert(precio);
          $("#precio_iva").val(precio);
        }
      });
    });
