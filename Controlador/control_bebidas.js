// funcion para marcar select por defecto bebidas
$(document).ready(function(){
  $("#idtipo").val("3");
});

/////////////////
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


function validar_existencia_producto(){
var producto=$('#nombreP').val();
$.ajax({
  type:"POST",
  dataType:"json",
  url:'Modelo/buscar_bebidas.php',
  data:{producto:producto},
  success:function(response){
    if(response.respuesta==true){
      new PNotify({title: 'Error',text: 'El producto '+response.mensaje+' ya se encuentra almacenado',type: 'error',delay: 2000});
      $('#nombreP').focus();
    }
  }
});
}
//FUNCIONES PARA INGRESAR BEBIDAS
$(document).ready(function(){
  $("#btn_producto").click(function(){
     if ($("#nombreP").val()== "") {
      new PNotify({title: 'Error',text: 'El campo nombre del Producto esta vacio',type: 'error',delay: 2000});
      $("#nombreP").focus();
    }else if ($("#precio").val()=="") {
      new PNotify({title: 'Error',text: 'El campo Precio esta vacio',type: 'error',delay: 2000});
      $("#precio").focus();
    }else if ($("#cantidad").val()=="") {
      new PNotify({title: 'Error',text: 'El campo Cantidad esta vacio',type: 'error',delay: 2000});
      $("#cantidad").focus();
    }
    else{
      var nombreP=$("#nombreP").val();
      var precio=$("#precio").val();
      var cantidad=$("#cantidad").val();
      var categoria=$("#idtipo").val();
      /*var dias=$("#dias").val();*/
      var stockmin=$("#stockmin").val();
      $.ajax({
        type:"POST",
        dataType:"json",
        url:'bebidas/insertar_bebidas.php',
        data:{nombreP:nombreP,precio:precio,cantidad:cantidad,idtipo:categoria,stockmin:stockmin},
        success:function(response){
          if(response.respuesta==true){
            $('#mensaje').fadeIn(3000);
            swal({   title: "Registro Correcto!",   text: "La Bebida se registro correctamente",   timer: 2000,   showConfirmButton: false });           
            $("#nombreP").val("");
            $("#precio").val("");
            $('#cantidad').val("");    
            $('#stockmin').val("");    

          }else
          {
            $("#mensaje").html(response.mensaje)
          }
        }

      });
    }});
  });

/////////////////////FUNCION PARA GESTION DE BEBIDAS////////////////////////////
function actualizar_bebidas(id){
  $.ajax({
    url:'bebidas/adminBebidas/consultar_bebidasxid2.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idbebida').val(response.Bid);
      $('#idbebidas').val(response.Bid);
      $('#nombre_bebida').val(response.Bnombre);
      $('#precio').val(response.Bprec);
      $('#cantidad').val(response.Bcantidad);
      $('#idtipo').val(response.Bcategoria)
      /*$('#dias').val(response.bdias);*/
      $('#stockmin').val(response.stockmin);
    }
  });
}
 

 function update_bebidas(){
  var id=$('#idbebidas').val();
  var nombre=$('#nombre_bebida').val();
  var precio=  $('#precio').val();
  var cantidad=$('#cantidad').val();
  var categoria=$('#idtipo').val();
  /*var dias=$('#dias').val();*/
  var stockmin=$('#stockmin').val();
  
    $.ajax({
    url:'bebidas/adminBebidas/update_bebidas.php',
    type:'POST',
    data:{id:id,nombre:nombre,precio:precio,cantidad:cantidad,categoria:categoria,stockmin:stockmin},
    success:function(response){
      swal({   title: "Actualización Correcta!",   text: "La bebida se ha actualizado de manera correcta.",   timer: 2000,   showConfirmButton: false });           
      $('#lista_productos').html(response);
    }
  });
}


function lista_bebidas(valor){
  $('#lista_productos').html("<img style='margin-left: 10cm' src='dist/img/platos.gif'> ");
  if(valor=="")
  {
  $('#lista_productos').html("No se encontraron resultados...");
  }else{
    $('#lista_productos').html("<img style='margin-left: 10cm' src='dist/img/platos.gif'> ");
    $.ajax({
      url:'bebidas/adminBebidas/consulta_bebidasxid.php',
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


function eliminar_bebidas(id){
  swal({   title: "¿Estás seguro?", 
   text: "De eliminar la bebida seleccionada!",  
   type: "warning", 
   showCancelButton: true,  
   confirmButtonColor: "#DD6B55", 
   confirmButtonText: "Si, Eliminar!",   
   cancelButtonText: "No, Cancelar!",   
   closeOnConfirm: false,  
    closeOnCancel: false 
},

 function(isConfirm){ 
   if (isConfirm) {     
    $.ajax({
      url:'bebidas/adminBebidas/delete_bebidas.php',
      type:'POST',
      data:{id:id},
      success:function(response){
        $('#lista_productos').html(response);
             }
    });
    swal("Elimnado!", "La bebida selecciona se elimino.", "success");   
   } else {    
    swal("Cancelada", "Operación cancelada :)", "error"); 
      }
       });

}