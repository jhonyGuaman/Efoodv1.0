//PARA GUARDAR EL ALMUERZO DEL DIA
$(document).ready(function() {
  $("#btn_sig").click(function(){
    guardar_almuerzos();
    $("#page-wrapper").load("configurar_plato.php");
  });
});

// FUNCION PARA GUARDAR EL MENU DEL DIA (ALMUERZOS)
function guardar_almuerzos(){
  var caldo1=$("#cmb_caldo1").val();
  var caldo2=$("#cmb_caldo2").val();
  var seco1=$("#cmb_seco1").val();
  var seco2=$("#cmb_seco2").val();
  var fecha=$("#fechaA").val();
  $.ajax({
    type:"POST",
    dataType:"json",
    url:'platos/guardar_almuerzos.php',
    data:{caldo1:caldo1,caldo2:caldo2,seco1:seco1,seco2:seco2,fecha:fecha},
    success:function(response){
      if(response.respuesta==true){
        alert("El almuerzo del dia se registro correctamente");
      }else{
        alert("Ocurrio un error inesperado");
      }
    }
    });
}

// PARA GUARDAR CONFIGURACION POR PLATOS

$(document).ready(function(){
  $("#btn_guardar2").click(function(){
      var nfilas=document.getElementById("tabla2").rows.length;
      var nfilas=nfilas-1;
      var fecha=$("#fechaA").val();
      var isOk=false;
      
      for(var x=0 ; x<nfilas ; x++){
          var id=$("#idPlato"+x).val();
          var cantidad=$("#cantidadP"+x).val();
        $.ajax({
            type:"POST",
            dataType:"json",
            url:'platos/insertar_stock2.php',
            data:{id:id,cantidad:cantidad,fecha:fecha},
            success:function(response){
              if(response.respuesta==true){
                  isOk=true;
                  
              }else{
                isOk=false;
                 
              }
            }
          });
      }// fin del for

      if(isOk==true){
        alert("Stock de platos Configurado Correctamente");
                  $("#btn_guardar2").attr('disabled', true);
                }else
                {
                   alert(" Ha ocurrido un Error inesperado..");
                }
  });
});

// PARA GUARDAR CONFIGURACION POR PRESAS
/*******funcion 
**
**
*/
$(document).ready(function(){
  $("#btn_guardar1").click(function(){
      var yea=document.getElementById("tabla1").rows.length;
      var yea=yea-1;
      var fecha=$("#fechaA").val();
      //alert("Numero de Filas: "+ yea);
      for(var x=0 ; x<yea ; x++){
          var id=$("#idPresa"+x).val();
          var presa1=$("#presa"+x+"1").val();
          var presa2=$("#presa"+x+"2").val();
          var presa3=$("#presa"+x+"3").val();
          var presa4=$("#presa"+x+"4").val();
          //alert(id+" "+presa1+" "+presa2+" "+presa3+" "+presa4);
          if(presa1=="" || presa2=="" || presa3=="" || presa4=="")
          {

            alert("Campos Vacios");
          }
          else{
          $.ajax({
            type:"POST",
            dataType:"json",
            url:'platos/insertar_stock1.php',
            data:{id:id,presa1:presa1,presa2:presa2,presa3:presa3,presa4:presa4,fecha:fecha},
            success:function(response){
              if(response.respuesta==true){
                  alert("Stock de presas Configurado Correctamente");
                  $("#btn_guardar1").attr('disabled', true);
              }else{
                  alert(" Ha ocurrido un Error inesperado..");
              }
            }
          });
        }
      }// fin del for

  });
});

$(document).ready(function(){
  $("#btn_guardar2").click(function(){
      var yea=document.getElementById("tabla2").rows.length;
      alert("Numero de Filas: "+ yea);
  });
});
