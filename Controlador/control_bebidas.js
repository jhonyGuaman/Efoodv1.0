// funcion para marcar select por defecto bebidas
$(document).ready(function(){
$("#idtipo").val("3");
//$('#idtipo').attr("")

});

/////////////////

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
      $('#dias').val(response.bdias);

    }
  });
}
 

 function update_bebidas(){
  var id=$('#idbebidas').val();
  var nombre=$('#nombre_bebida').val();
  var precio=  $('#precio').val();
  var cantidad=$('#cantidad').val();
  var categoria=$('#idtipo').val();
  var dias=$('#dias').val();
    $.ajax({
    url:'bebidas/adminBebidas/update_bebidas.php',
    type:'POST',
    data:{id:id,nombre:nombre,precio:precio,cantidad:cantidad,categoria:categoria,dias:dias},
    success:function(response){
      $('#exito').show();
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
  divResultado = document.getElementById('lista_productos');
  var opcionEliminar= confirm("Esta seguro Eliminar el producto");
  if (opcionEliminar)
  {
    $.ajax({
      url:'bebidas/adminBebidas/delete_bebidas.php',
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
////////////////////////////////////