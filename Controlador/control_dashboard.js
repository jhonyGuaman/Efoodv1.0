var cont=0;
$(document).ready(function(){
	 Contar_Stock_Productos();
	 Contar_Stock_Bebidas();
   Total_del_dia();
});


function Total_del_dia(){

  var hoy = new Date();
  var dd = hoy.getDate();
  var mm = hoy.getMonth()+1; //hoy es 0!
  var yyyy = hoy.getFullYear();

if(dd<10) {
    dd='0'+dd
}
if(mm<10) {
    mm='0'+mm
}
hoy = dd+'-'+mm+'-'+yyyy;

$.ajax({
    url:'Modelo/consultar_total.php',
    type:'POST',
    dataType:'json',
    data:{fecha:hoy},
    success:function(response){
      $("#totalV").html('$'+response.contador);
    }
  });
}

function Contar_Stock_Productos(){
	$.ajax({
    url:'Modelo/consultar_stock.php',
    type:'POST',
    dataType:"json",
     success:function(response){
     	$("#numProd").html(response.contador)
          }
  });
}

function Contar_Stock_Platos(){
  $.ajax({
    url:'Modelo/consultar_stock.php',
    type:'POST',
    dataType:"json",
     success:function(response){
      $("#numPlato").html(response.contador)
          }
  });
}


function Contar_Stock_Bebidas(){
	$.ajax({
    url:'Modelo/consultar_stockBebidas.php',
    type:'POST',
    dataType:"json",
     success:function(response){
     	$("#numBebidas").html(response.contador)
          }
  });
}