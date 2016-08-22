/**
*@autor  Jhony Guaman, John Morrillo
*@date   14/Octubre/2015
* Clase control_login el permite llevar el proceso de login  
*/
$("#login").click(function(){
  iniciarS();
});
$("#clave").keypress(function(tecla) {
  if(tecla.which == 13){
   iniciarS();
  }
});

/**
    *@autor    Jhony Guaman & John Morrillo
    *@date      14/Octubre/2015
    *@name      iniciarS 
    * Método iniciar sesion que permite el login al usuario 
    * consultando a la base de datos y redireccionando a la ventana principal admin.php
*/
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

