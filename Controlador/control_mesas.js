
$(document).ready(function(){
$("#btn_mesa").click(function(){
  if($("#mesa").val()==""){
    new PNotify({title: 'Error',text: 'El numero de mesa se encuentra vacio',type: 'error',delay: 2000});
    $("#mesa").focus();
  }else{
  guardar_mesa();
      }
    });
});
$("#mesa").keypress(function(tecla) {
  if(tecla.which == 13){
    if($("#mesa").val()==""){
      new PNotify({title: 'Error',text: 'El numero de mesa se encuentra vacio',type: 'error',delay: 2000});
      $("#mesa").focus();
    }else{
    guardar_mesa();
        }
  }
});


function guardar_mesa(){
var mesa= $("#mesa").val();
$.ajax({
  type:"POST",
  dataType:"json",
  url:'Modelo/registrar_mesa.php',
  data:{mesa:mesa},
  success:function(response){
    if(response.respuesta==true){
    show_stack_bottomright('success');
    $("#mesa").val("");
    $("#mesa").focus();
    }else{

    }
  }
});

}


function actualizar_mesa(id){
  //divResultado = document.getElementById('lista1');
  $.ajax({
    url:'mesas/consulta_mesaporId.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idMe').val(response.Mid);
      $('#idMesa').val(response.Mid);
      $('#num_mesa').val(response.Mnumero);

    }
  });
}

function update_mesas(){
  var datosform=$("#formMesas").serialize();
  $.ajax({
    url:'mesas/update_mesas.php',
    type:'POST',
    data:datosform,
    success:function(response){
      $('#exito').show();
      $('#listaMesas').html(response);
    }
  });
}


function eliminar_mesas(id){
  //divResultado = document.getElementById('lista_platos');
  var opcionEliminar= confirm("Esta seguro eliminar la mesa");
  if (opcionEliminar)
  {
    $.ajax({
      url:'mesas/delete_mesas.php',
      type:'POST',
      data:{id:id},
      success:function(response){
        //alert("Tipo ha sido elimindado correcto");
        $('#listaMesas').html(response);
        //divResultado.innerHTML = ajax.responseText
      }
    });
  }
}
