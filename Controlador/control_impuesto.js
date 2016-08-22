var estado="";
$('input').on('ifChecked', function(){
  		estado="activo";
});
$('input').on('ifUnchecked', function(){
  		estado="desactivado";
});

$(document).ready(function(){
	$('input').iCheck('uncheck'); 
});

$('#btn_iva').click(function(){
	guardar_impuesto();
});
$('#btn_cancelar').click(function(){
	limpiar_campos();
});

function limpiar_campos(){
	$('#impuesto1').val("");
    $('#valor1').val("");
	$('input').iCheck('uncheck'); 
}
function guardar_impuesto(){
	var impuesto =$('#impuesto1').val();
	var valor	 =$('#valor1').val();	
	$.ajax({
	  type:"POST",
      dataType:"json",
      url:'configuraciones/insertar_impuesto.php',
      data:{impuesto:impuesto,valor:valor,estado:estado},
      success:function(response){
      	if(response.respuesta==true){
      		swal("Efoof!", response.mensaje, "success")
      		limpiar_campos();
    
      	}
      }
	});
}

function actualizar_impuesto(id){
	$.ajax({
    url:'configuraciones/buscar_impuestoxid.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idimpuesto').val(response.Iid);
      $('#idimpuestos').val(response.Iid);
      $('#impuesto').val(response.Iimpuesto);
      $('#valor').val(response.Ivalor);
      if(response.Iestado=="activo"){
		$('input').iCheck('check');
      }else{
      	$('input').iCheck('uncheck'); 
      }
      
    }
  });
}

function update_impuesto(){
  	var idI   	 =$('#idimpuesto').val();
	var impuesto =$('#impuesto').val();
  	var valor	 =$('#valor').val();	
  	$.ajax({url:'configuraciones/update_impuesto.php', type:'POST',data:{idI:idI,impuesto:impuesto,valor:valor,estado:estado},
    success:function(response){
         swal({   title: "Actualización Correcta!",   text: "Impuesto actualizado correctamente.",   timer: 2000,   showConfirmButton: false });           
         $('#lista_impuestos').html(response);
    }
  });
}

function eliminar_impuesto(id){
  swal({   title: "¿Estás seguro?", 
   text: "De el impuesto seleccionado!",  
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
    swal("Impuesto eliminado!", "El impuesto se elimino correctamente.", "success");   
    $.ajax({
      url:'configuraciones/delete_impuesto.php',
      type:'POST',
      data:{id:id},
      success:function(response){
        $('#lista_impuestos').html(response);
      }
    });
   }
  });
}