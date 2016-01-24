
$("#login").click(function(){
  iniciarS();
});
$("#clave").keypress(function(tecla) {
  if(tecla.which == 13){
    
    iniciarS();
  }
});

function iniciarS(){
  var Usuario=$('#user').val();
  var Contrasena=$('#clave').val();
  $.ajax({
    type:"POST",
    dataType:"json",
    url:'includes/loginAjax.php',
    data:{Usuario:Usuario,Contrasena:Contrasena},
    success:function(response){
      if(response.respuesta==true){
        $("#mensajeLogin").fadeIn(500);
        window.location='admin.php';
      }else{
        $('#errorC').fadeIn(2000);
        $('#errorC').fadeOut(1000);
      }
    }
  });
}
