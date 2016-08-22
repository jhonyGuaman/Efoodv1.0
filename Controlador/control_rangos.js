$(document).ready(function(){
	$('#btn_rangos').click(function(){
		registrar_rango();
	});
});

function registrar_rango(){
	var ruc=$('#ruc').val();
	var desde=$('#desde').val();
	var hasta=$('#hasta').val();
	if(ruc==""){
      swal("Efoof!", "El campo ruc es encuentra vacio", "error");
      $('#ruc').focus();
	}else{
		$.ajax({
		url:"configuraciones/rangoFacturas/registrar_rangos.php",
		data:{ruc:ruc,desde:desde,hasta:hasta},
	  	type:"POST",
	  	dataType:'json',
	  	success:function(data){
	  		if(data.respuesta==true){
	  			alert(data.mensaje);
	  			$("#myModal").modal("hide");
      			//$("#page-wrapper").load('configuraciones/rangoFacturas/rangos.php');
      			$("#lista_rangos").load('configuraciones/rangoFacturas/consultar_rangos.php');
	  		}
	  	}
		});
	}
}

function actualizar_rango(id){
	var $range = $("#rangosA");
	$.ajax({
    url:'configuraciones/rangoFacturas/buscar_rangoxid.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idrango').val(response.Rid);
      $('#idrangos').val(response.Rid);
      $('#rucA').val(response.Rruc);
      $('#desdeA').val(response.Rdesde);
      $('#hastaA').val(response.Rhasta);
      	slider = $range.data("ionRangeSlider");
    	slider && slider.update({
      	from: response.Rdesde,
      	to: response.Rhasta,
      	disable: true,
    	});
    }
  });
}

function calcular_rango(id){
	var $range = $("#rangosA");
	$.ajax({
    url:'configuraciones/rangoFacturas/buscar_rangoxid.php',
    type:'POST',
    dataType:"json",
    data:{id:id},
    success:function(response){
      $('#idrango').val(response.Rid);
      $('#idrangos').val(response.Rid);
      $('#rucA').val(response.Rruc);
      $('#desdeA').val(parseInt(response.Rhasta)+1);
      $('#hastaA').val(parseInt(response.Rhasta)+100);
       slider = $range.data("ionRangeSlider");
    	slider && slider.update({
        min: response.Rdesde,
      	from: parseInt(response.Rhasta)+1,
      	to: parseInt(response.Rhasta)+100,
      	disable: false,
    	});
    }
  });
}

function elimniar_numero(id){
  $.ajax({
    url:'configuraciones/rangoFacturas/cargar_numeroF.php',
    type:'POST',
    dataType:'json',
    data:{id:id},
    success:function(response){
      $('#idrangosE').val(response.Rid);
      $('#rucE').val(response.Rruc);
        if(parseInt(response.Rdesde)+1<10){
          $('#desdeE').val("00000000"+(parseInt(response.Rdesde)+1).toString());
        }else if(parseInt(response.Rdesde)+1<100){
          $('#desdeE').val("0000000"+(parseInt(response.Rdesde)+1).toString());
        }else if(parseInt(response.Rdesde)+1<1000){
          $('#desdeE').val("000000"+(parseInt(response.Rdesde)+1).toString());
        }else if(parseInt(response.Rdesde)+1<10000){
          $('#desdeE').val("00000"+(parseInt(response.Rdesde)+1).toString());
        }
    }
  });
}

/*revisar */
function dar_Baja(){
  var id     = $('#idrangosE').val();
  var desde  = parseInt($('#desdeE').val());

  $.ajax({
    url:'configuraciones/rangoFacturas/dar_Baja.php',
    type: 'POST',
    data: {id:id,desde:desde},
    dataType: 'json',
    success:function(res){
      $("#Modal_eliminar_Factura").modal("hide");
      $("#lista_rangos").html(res);
    }
  });

}

function update_rango(){
  var idR   =$("#idrangos").val();
  var rucR  =$("#rucA").val();
  var desdeR=$("#desdeA").val();
  var hastaR=$("#hastaA").val();

  $.ajax({
    url:'configuraciones/rangoFacturas/update_rangos.php',
    type:'POST',
    data:{id:idR,ruc:rucR,desde:desdeR,hasta:hastaR},
    success:function(data){
      $("#Modal_actualizarRango").modal("hide");
      swal("Actualización Exitosa!", "precione el boton para continuar!", "success")
      $("#lista_rangos").html(data);
    }
  });
}

function destruir_rango(){
	var $range = $("#rangosA");
	slider = $range.data("ionRangeSlider");
    slider && slider.destroy();
    $("#rangosA").val("");
}

function eliminar_rango(id){
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
      url:'configuraciones/rangoFacturas/delete_rango.php',
      type:'POST', 
      data:{id:id},
      success:function(response){
        $('#lista_rangos').html(response);
      }
    });
   }
  });
}