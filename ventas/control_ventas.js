
$(document).ready(function(){
                fn_dar_eliminar();
				        fn_cantidad();
            });

function actualizar_stock(){
var cantidad =$("#Tcantidad1").val();
var codigo =$("#cmb_producto").val();
$.ajax({
  type:"POST",
  dataType:"json",
  url:'ventas/actualizar_stock.php',
  data:{cantidad:cantidad,codigo:codigo},
  success:function(response){

  }
});

}


function fn_cantidad(){
  cantidad = $("#tabla_detalle  tbody").find("tr").length;
  $("#span_cantidad").val(cantidad);
};

function fn_agregar(){
    nfila = $("#tabla_detalle  tbody").find("tr").length; // contamos los numero de filas (tr)
    nfila=nfila+1;
    var codigo=$('#cmb_producto').val();
    var descripcion = $("#cmb_producto option:selected").html();
    var precio=$('#precio').val();
    var cant_=0;
    var y=0;
for(var x=1 ;x<=nfila ;x++){
    if($("#codigo"+x+"").val()==codigo){
    cant_=parseFloat($('#Tcantidad'+x+'').val())+1;
    $('#Tcantidad'+x+'').val(cant_);
    y=y+1;
    calcular_total(x);
    }
  } //FIN DEL FOR

  if(y==0){
    cadena = "<tr>";
    cadena = cadena + "<td>"+ nfila +"</td>";
    cadena = cadena + "<td class='fila'><input type='text' name='Tcantidad"+nfila+"' id='Tcantidad"+nfila+"' onkeyup='calcular_total("+nfila+");' value='1'><input type='hidden' id='codigo"+nfila+"' value='" + codigo  + "'></td>";
    cadena = cadena + "<td>" + descripcion  + "</td>";
    cadena = cadena + "<td class='precio'> <input type='text' name='precio"+nfila+"' id='precio"+nfila+"' value='"+precio+"'></td>";
    cadena = cadena + "<td class='fila_total'><input type='text' id='sp_total"+nfila+"' value='"+precio*1+"'></input></td>";
    cadena = cadena + "<td><a class='elimina'><img src='dist/img/delete.png' /></a></td>";
    $("#tabla_detalle tbody").append(cadena);
  }

      fn_dar_eliminar();
      fn_cantidad();
      sumar_total();
      buscariva();
};

      function fn_dar_eliminar(){
          $("a.elimina").click(function(){
              id = $(this).parents("tr").find("td").eq(0).html();
              respuesta = confirm("Desea eliminar el usuario: " + id);
              if (respuesta){
                  $(this).parents("tr").fadeOut("normal", function(){
                      $(this).remove();
                      alert("Usuario " + id + " eliminado")
                      fn_cantidad();
                      sumar_total();
                      /*
                          aqui puedes enviar un conjunto de datos por ajax
                          $.post("eliminar.php", {ide_usu: id})
                      */
                  })
              }
          });
      };


    function calcular_total(aux){
        var cantidad =$("#Tcantidad"+aux+"").val();
        //alert("cantidad "+cantidad);
        var precio=$("#precio"+aux+"").val();
        //alert("precio "+precio);
        var total= cantidad*precio;
        $("#sp_total"+aux+"").val(total);
        sumar_total();
        buscariva();


      };

      function sumar_total(){
        nfila = $("#tabla_detalle  tbody").find("tr").length; // contamos los numero de filas (tr)
        //nfila=;
        //alert("Numero de filas fn_sumar_total :"+nfila);
        var total=0;
        for(x=1; x<=nfila; x++){
          //alert("fila "+x)
          total+=parseFloat($("#sp_total"+x+"").val());
        }
        //alert("Total: "+total);
        $("#total_p").val("$"+total);
        $("#totalp").val("$"+total);
        $("#subtotal").val(total);
      }



function buscariva(){
  nfila=$("#tabla_detalle  tbody").find("tr").length;
    for(var i=1 ; i<=nfila; i++){
      if($("#codigo"+i+"").val()>=101){
      //alert("valor de x afuera "+i);
        var idS=$("#codigo"+i+"").val();
        //alert("valor de x: "+i);
        var total=parseFloat($("#sp_total"+i+"").val());
        var iva= total*0.12;
        var subtot=parseFloat($("#subtotal").val());
        $("#subtotal").val(subtot-iva);
        //alert("sub total: "+total);
        $("#iva12").val(iva);
        sumar_iva();
        //fn_dar_eliminar();
     /*$.ajax({
        type:"POST",
        dataType:"json",
        url:'ventas/buscariva.php',
        data:{idS:idS},
        success:function(response){
          if(response.respuesta=='iva12'){

          }else{
            //alert("producto con iva 0 %");
            //$("#iva0").val(response.iva);
              var total=parseFloat($("#sp_total"+i+"").val());
              $("#iva0").val(total);
          }
        }
      });*/
    }else{
      //alert("los otros productos son platos");
    }

  } // fin del for
}//fin de la funcion buscar

var iva_=0;
function sumar_iva(){
  alert(iva);
iva_=parseFloat($("#iva12").val());
alert(iva_);
//iva_=iva_+;
$("#iva12").val(iva_);
}

$(document).ready(function() {
  $('select#cmb_producto').on('change',function(){
    var idS =$(this).val();
    //alert(idS);
    var x=0;
    $.ajax({
        type:"POST",
        dataType:"json",
        url:'ventas/crear_cmbxCant.php',
        data:{idS:idS},
        success:function(response){
          if(response.mensaje=='iva')
          {
            $("#Npresas").fadeOut(500);
            $("#precio").val(response.precio);
            $("#cantidad").val(response.cantidad);
            //$("#iva12").val(response.precio2);
            x++;
            //alert("producto con iva")
          }
          if(x==0){
            if(response.mensaje==true){
              $("#Npresas").fadeOut(500);
              $("#precio").val(response.precio);
              $("#cantidad").val(response.cantidad);
            }else{
              $("#Npresas").fadeIn(500);
              $("#Npresas").html(response.cmb);
              $("#precio").val(response.precio);
              $("#cantidad").val("");
              select_();
          }
        }
        }
    });
  });
});


function select_(){
  $('#cbm_presas').on('change',function(){
    var valor =$(this).val();
    var id=$("#cmb_producto").val();
    //alert(id +" "+ valor);
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'ventas/cargar_datos.php',
      data:{valor:valor,id:id},
      success:function(response){
        $('#cantidad').val(response.cantidad);
      }
    });
  });
}



$("#display").blur(function(){
  $("#display").hide();
});

$("#btn_bus_us").click(function() {
  buscar_plato();
});


$("#buscar").keypress(function(tecla) {
        if(tecla.which == 13){
           buscar_plato();
        }
});

$("#buscar").keyup(function(){
  buscar_plato();
});


$("#cedula_buscar").keypress(function(tecla){
    if(tecla.which == 13){
        buscar_cliente();
    }
});



function seleccionar(id){
  //$('#display').hide();
  //$('#buscar').val(id);
  alert("mensaje alerta"+id);
}

function buscar_cliente(){

  var cedula=$("#cedula_buscar").val();
  if(cedula==""){
    $('#aceptar').html("");
    $('#negar').html("<i class='fa  fa-times-circle-o'></i> <label for='notificar' >Campo cedula vacio</label>");
  }else{
  $('#aceptar').html("<img style='margin-left: 10cm' src='dist/img/buscar.gif'> ");
  $.ajax({
    url:'ventas/buscar_cliente.php',
    dataType:"json",
    type:'POST',
    data:{cedula:cedula},
    success:function(response){
      setTimeout(function(){
      if(response.respuesta==true){
        //alert("encontrado");
        $("#cedula_buscar").val(response.mensaje);
        $("#negar").html("");
        $('#aceptar').html("<i class='fa fa-check-circle-o'></i> <label for='notificar' >Cliente Aceptado "+response.cliente+"</label>");
        }else{
        $('#aceptar').html("");
        $('#negar').html("<i class='fa  fa-times-circle-o'></i> <label for='notificar' >Cliente no Registrado</label>");
        }
        },2000);


    }
  });
}
}
