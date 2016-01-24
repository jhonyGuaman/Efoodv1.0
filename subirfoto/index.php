<!DOCTYPE html>
<html>

<head>
	<title>Subir y Cargar la Foto </title>
	<link href="css/bootstrap.css" rel="stylesheet" media="screen">
        <!-- Javascript -->
        <script src="js/jquery-2.0.2.js"></script>
        <script src="js/upload.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<style>
.desvanecer{
    display: none;

}

.contenedor{
    width: 200px;
    height: 200px;

}

</style>

        <script type="text/javascript">

        $(function(){
			$("input[name='file']").on("change",function(){
				var formData = new FormData($("#form1")[0]);
				var ruta = "imagen-ajax.php";
                alert(formData);
				$.ajax({
					url: ruta,
					type:"POST",
					data: formData,
					contentType: false,
					processData: false,
                    beforeSend: function(){
                       $('.fa').css('display','inline'); 
                    },
					success: function(datos)
					{   
                         setTimeout(function(){
                              $('.fa').hide();  
                          },2000); 
                        $('#respuesta').fadeIn(2000);
						$("#respuesta").html(datos);
					}
				});
			});
        });

        $(function(){
        	$("#cancelar").on("click",function(){
        var archivo =$('#archivo').val();
      
                $.ajax({ 
                    url: 'eliminar_archivo.php',
                    type: 'POST',
                    timeout: 10000,
                    data: {archivo: archivo},
                    error: function() {
                        mostrarRespuesta('Error al intentar eliminar el archivo.', false);
                    },
                    beforeSend: function(){
                       $('.fa').css('display','inline'); 
                    },
                    success: function(respuesta) {
                        if (respuesta == 1) {
                             setTimeout(function(){
                              $('.fa').hide();  
                          },2000);
                             $('#file').val('');
                             $('#archivo').val('');
                            mostrarRespuesta('La Foto ha sido Removida.', true);


                        } else {
                            mostrarRespuesta('Error al intentar eliminar el archivo.', false);                            
                        }
                       
                    }
                });
        	});
        });

         
        $(document).ready(function(){
            $("#subir").on("click",function(){
                  var archivo =$('#archivo').val();
                  $.ajax({
                    type:"POST",
                    dataType:"json",
                    url:'guardar.php',
                    data: {archivo: archivo},
                    success:function(response){
                        if(response.respuesta==true)
                        {
                            alert("Usuario Registrado Correctamente");
                             $('#file').val('');
                             $('#archivo').val('');
                             $('#respuesta').fadeOut(2000);
                        }else
                            {
                            $("#respuesta").html(response.mensaje)
                            }
                        }
                    
                  });
            });
        });

              function mostrarRespuesta(mensaje, ok){
                $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
                if(ok){
                    $("#respuesta").addClass('alert-success');
                }else{
                    $("#respuesta").addClass('alert-danger');
                }
            }
        
        </script>
        
</head>
<body>
<div class="container">
		<h1>CARGAR IMAGEN </h1>
		<form  method="POST" id="form1" enctype="multipart/form-data">
					<div class="input-group">
                        <input type="file" id="file" name="file">  <i class="fa fa-refresh fa-spin desvanecer"></i>		
                    </div>
		</form>
			<hr />
			<div id="respuesta" class="contenedor">
                   
					</div>
                			<div class="row">
				<div class="col-lg-6">
					<button type="button" id="subir" name="subir" class="btn btn-success">SUBIR IMAGEN</button>
					<button type="button" id="cancelar" name="cancelar" class="btn btn-danger">CANCELAR</button>

				</div>
			</div>
		
		
</div>

</body>
</html>