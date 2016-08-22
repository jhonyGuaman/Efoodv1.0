
$("#cedula").keypress(function(tecla) {
  if(tecla.which == 13){
    if($("#cedula").val()==""){
       new PNotify({title: 'Error',text: 'El campo cedula se encuenta vacio',type: 'error',delay: 2000});    
    }else{
      buscar_cedulaUsuario();
    }
  }
});

$("#gempleado").click(function(){
  if($("#cedula").val()=="" ){
  alert("Por Favor ingrese la cedula del Usuario");
  }else if( $("#nombre").val()==""){
  alert("Por Favor ingrese el nombre del usuario");
  }else if($('#ape_paterno').val()==""){
  alert("Por Favor ingrese el Apellido Paterno");
  }else if($("usuario").val()==""){
  alert("Por Favor ingrese el Nombre de Usuario");
  }else{
  registrar_usuario();
  }
});

/*
    *@autor    Jhony Guaman & John Morrillo
    *@date     16/Diciembte/2015
    *@name     precionar_tab
    *          Método precionar_tab permite controlar el evento de la tecla tab 
    *@param    event
    *@return   true  
*/
function precionar_tab( event ){
  var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
  if (keyCode == 9)
  {
    if($("#cedula").val()==""){
       new PNotify({title: 'Error',text: 'El campo cedula se encuenta vacio',type: 'error',delay: 2000});
      $("#cedula").focus();
    }else{
      buscar_cedulaUsuario();
      return true;
    }
  }
}
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date     16/Diciembre/2015
    *@name     buscar_cedulaUsuario
    *          Método buscar_cedulaUsuario permite controlar el registro de usuarios
*/
function buscar_cedulaUsuario(){
  var cedula=$("#cedula").val();
  //alert(cedula);
  $.ajax({
    type:"POST",
    dataType:"json",
    url:'usuarios/buscar_usuario.php',
    data:{cedula:cedula},
    success:function(response){
      if(response.respuesta==true){
        //$('#mensaje').fadeIn(3000);
       // alert(response.mensaje);
         new PNotify({title: 'Error',text: 'El usuario '+response.mensaje+' ya se encuentra registrado',type: 'error',delay: 2000});
         $('#cedula').focus();
      }
    }
  });
}
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date     16/Diciembre/2015
    *@name     registrar_usuario
    *          Método registrar_usuario permite registrar los usuarios
*/
function registrar_usuario(){
    var cedula=$('#cedula').val();
    var nombre=$('#nombre').val();
    var apellidopat=$('#ape_paterno').val();
    var apellidomat=$('#ape_materno').val();
    var usuario=$('#usuario').val();
    var telefono=$('#telefono').val();
    var clave =$('#clave').val();
    var foto=$('#archivo').val();
    var direcion=$('#direcion').val();
    var tipo=$("#tipo").val();
    $.ajax({
      type:"POST",
      dataType:"json",
      url:'includes/usuarioAjax.php',
      data:{cedula:cedula,nombre:nombre,apellidopat:apellidopat,apellidomat:apellidomat,usuario:usuario,telefono:telefono,clave:clave,foto:foto,direcion:direcion,tipo:tipo},
      success:function(response){
        if(response.respuesta==true){
          $('#mensaje').fadeIn(3000);
         swal({   title: "Registro Correcto!",   text: "El usuario se ha registrado de manera correcta.",   timer: 2000,   showConfirmButton: false });           
         
        }else
        {
          $("#mensaje").html(response.mensaje)
        }
      }
    });
  }

/*
    *@autor    Jhony Guaman & John Morrillo
    *@date     16/Diciembre/2015
    *@name     cargar_usuarios
    *          Método cargar_usuarios permite mostrar todos los usuarios registrados 
  
*/
  function cargar_usuarios(){
    $('#lista_usuarios').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");
    $.ajax({
      url:'usuarios/consulta_usuarios.php',
      success:function(response){
        setTimeout(function(){
          $('#lista_usuarios').html(response);
        },2000);

      }
    });
  }


/*
    *@autor    Jhony Guaman & John Morrillo
    *@date     16/Diciembre/2015
    *@name     lista_usuarios
    *          Método lista_usuarios permite mostrar el usuario los usuarios registrados 
    *@param    valor
  
*/
  function lista_usuarios(valor){

    $('#lista_usuarios').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");

    if(valor ==" ")
    {
      $('#lista_usuarios').html("No se encontraron resultados...");
    }else{
      $('#lista_usuarios').html("<img style='margin-left: 10cm' src='dist/img/cargando_clientes.gif'> ");
      $.ajax({
        url:'usuarios/consulta_porId.php',
        type:'POST',
        data:{valor:valor},
        success:function(response){
          setTimeout(function(){
            $('#lista_usuarios').html(response);
          },2000);

        }
      });
    }
  }

/*
    *@autor    Jhony Guaman & John Morrillo
    *@date     16/Diciembre/2015
    *@name     actualizar_usuarios
   * Método actualizar_usuarios permite buscar el clientge en la base de datos
    * y cargando los datos obtenidos en el formularios de actualizacion 
    @param     id   
*/
  function actualizar_usuarios(id){
    //divResultado = document.getElementById('lista1');
    $.ajax({
      url:'usuarios/consultar_porId2.php',
      type:'POST',
      dataType:"json",
      data:{id:id},
      success:function(response){
        $('#idP').val(response.Pid);
        $('#idU').val(response.Uid);
        $('#nombre').val(response.Unombre);
        $('#apePat').val(response.UapeP);
        $('#apeMat').val(response.UapeM);
        $('#cedula').val(response.Ucedula);
        $('#direcion').val(response.Udirecion);
        $('#telefono').val(response.Utelefono);
        $('#clave').val(response.Uclave)

      }
    });
  }
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      16/Diciembte/2015
    *@name     update_usuarios 
    * Método update_usuarios permite obtener los datos del formulario
    * para asi realizar el respectivo update 
*/

  function update_usuarios(){
    var datosform=$("#formUsuario").serialize();
    $.ajax({
      url:'usuarios/update_usuarios.php',
      type:'POST',
      data:datosform,
      success:function(response){
         swal({   title: "Actualización Correcta!",   text: "El usuario se ha actualizado de manera correcta.",   timer: 2000,   showConfirmButton: false });           
         $('#lista_usuarios').html(response);
      }
    });
  }
/*
    *@autor    Jhony Guaman & John Morrillo
    *@date      30/Diciembte/2015
    *@name     eliminar_usuario
    * Método eliminar_usuario permite eliminar el usuario
    *@param     id 
*/
  function eliminar_usuario(id){
    swal({   title: "¿Estás seguro?", 
   text: "You will not be able to recover this imaginary file!",  
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
    swal("Eliminacion!", "El usuarios seleccionado ha sido elimindado correctamente.", "success");   
        $.ajax({
        url:'usuarios/delete_usuario.php',
        type:'POST',
        data:{id:id},
        success:function(response){       $('#lista_usuarios').html(response);       }
      });
   } 
       });

  }



