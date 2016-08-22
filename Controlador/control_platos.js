
$(document).ready(function(){
  $("#nombre_plato").focus();
  $("#nombre_plato").focusout(function(){
    if($("#nombre_plato").val()==""){
        $("#nombre_plato").focus();
    }else{
    validar_existencia();
  }
  });
});

/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      27/Diciembte/2015
    *@name      validar_existencia 
    * Método validar_existencia que permite controlar la existencia del plato 
*/

 function responTabla(){
  $('#tablaPlatos').DataTable();
 }
function validar_existencia(){
var plato=$('#nombre_plato').val();
$.ajax({
  type:"POST",
  dataType:"json",
  url:'Modelo/buscar_platos.php',
  data:{plato:plato},
  success:function(response){
    if(response.respuesta==true){
      new PNotify({title: 'Error',text: 'El plato '+response.mensaje+' ya se encuentra almacenado',type: 'error',delay: 2000});
      $('#nombre_plato').focus();
    }
  }
});
}
//FUNCIONES PARA INGRESAR PLATOS
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      30/Diciembre/2015
    *@name      registrar_plato 
    * Método registrar plato que permite registrar el plato 
*/
$(document).ready(function(){
  $("#btnplato").click(function(){
    if($("#nombre_plato").val()==""){
      new PNotify({title: 'Error',text: 'El campo nombre del plato esta vacio',type: 'error',delay: 1500});
      $("#nombre_plato").focus();
    }else if ($('#precio').val()=="") {
      new PNotify({title: 'Error',text: 'El campo precio del plato esta vacio',type: 'error',delay: 1500});
      $("#precio").focus();
    }else if ($('#idtipo').val()=="") {
      new PNotify({title: 'Error',text: 'No ha seleccionado la categoria del plato',type: 'error',delay: 1500});
      $("#idtipo").focus();
    }else if ($('#idxcantidad').val()=="") {
      new PNotify({title: 'Error',text: 'No ha seleccionado ?',type: 'error',delay: 1500});
      $("#idxcantidad").focus();
    }else if ($('#dias').val()=="") {
      new PNotify({title: 'Error',text: 'No ha seleccionado los días disponibles del plato ',type: 'error',delay: 1500});
      $("#dias").focus();
    }else{
    var nombreplato=$('#nombre_plato').val();
    var precio=$('#precio').val();
    var idtipo=$('#idtipo').val();
    var idxcantidad=$('#idxcantidad').val();
    //var dias=$('#dias').val();
  //var cantidad=$("#cantidad").val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'platos/insertar_platos.php',
      data:{nombreplato:nombreplato,precio:precio,idtipo:idtipo,idxcantidad:idxcantidad},//,dias:dias},
      success:function(response){
        if(response.respuesta==true){
          show_stack_bottomright('success','Plato registrado correctamente')
          $("#nombre_plato").val("");
          $("#precio").val("");
          $('#idtipo').val("0");
          $('#idxcantidad').val("0");
          //$('#dias').val("0");
          $('#cantidad').val("");
        }else
        {
          show_stack_bottomright('error','Error al guardar el plato')
        }
      }
    });
   }
  });
});

/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      30/Diciembte/2015
    *@name     lista_platos 
    * Método lista_platos mostrar todos los platos registrados.
    @param     valor 
*/
function lista_platos(valor){
  $('#lista_platos').html("<img style='margin-left: 10cm' src='dist/img/platos.gif'> ");
  if(valor=="")
  {
  $('#lista_platos').html("No se encontraron resultados...");
  }else{
    $('#lista_platos').html("<img style='margin-left: 10cm' src='dist/img/platos.gif'> ");
    $.ajax({
      url:'platos/adminPlatos/consulta_platosxid.php',
      type:'POST',
      data:{valor:valor},
      success:function(response){
        setTimeout(function(){
          $('#lista_platos').html(response);
        },2000);

      }
    });
  }
}
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      30/Diciembte/2015
    *@name     actualizar_platos 
    * Método actualizar_platos permite buscar el plato en la base de datos
    * y cargando los datos obtenidos en el formularios de actualizacion 
    @param     id 
*/
function actualizar_platos(id){
  //divResultado = document.getElementById('lista1');
  $.ajax({
    url:'platos/adminPlatos/consultar_platosxid2.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idplato').val(response.Pid);
      $('#idplatos').val(response.Pid);
      $('#nombre').val(response.Pnombre);
      $('#precio').val(response.Pprecio);
      $('#idtipo').val(response.Ptipo);
      $('#idxcantidad').val(response.Pxcant);
      //$('#dias').val(response.Pdias);

    }
  });
}
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      30/Diciembte/2015
    *@name     update_platos 
    * Método update_platos permite obtener los datos del formulario
    * para asi realizar el respectivo update 
*/
function update_platos(){
  //var datosform=$("#formplatos").serialize();
  var id=$('#idplato').val();
  var nombre=$('#nombre').val();
  var precio=  $('#precio').val();
  var idTipo=$('#idtipo').val();
  var idcant=$('#idxcantidad').val();
  //var dias=$("#dias").val();
    $.ajax({
    url:'platos/adminPlatos/update_platos.php',
    type:'POST',
    data:{id:id,nombre:nombre,precio:precio,idTipo:idTipo,idcant:idcant},//dias:dias},
    success:function(response){
       swal({   title: "Actualización Correcta!",   text: "El plato se ha actualizado de manera correcta.",   timer: 2000,   showConfirmButton: false });           
        $('#lista_platos').html(response);
    }
  });
}
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      30/Diciembte/2015
    *@name     eliminar_platos
    * Método eliminar_platos permite eliminar el plato
    *@param     id 
*/
function eliminar_platos(id){
  swal({   title: "¿Estás seguro?", 
   text: "De eliminar el plato seleccionado!",  
   type: "warning", 
   showCancelButton: true,  
   confirmButtonColor: "#DD6B55", 
   confirmButtonText: "Si, Eliminar!",   
   cancelButtonText: "No, Cancelar!",   
   closeOnConfirm: false,  
    closeOnCancel: true 
},

 function(isConfirm){ 
   if (isConfirm) {     
    swal("Plato eliminado!", "El plato se elimino correctamente.", "success");   
    $.ajax({
      url:'platos/adminPlatos/delete_platos.php',
      type:'POST',
      data:{id:id},
      success:function(response){
        $('#lista_platos').html(response);
      }
    });
   }
  });
}
  

