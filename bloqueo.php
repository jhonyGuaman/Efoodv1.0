<!DOCTYPE html>
<?php
include_once('conexion/db.php');
session_start();
$id = $_SESSION['id'];
$consulta =pg_query($conexion,("Select (nombre||' '|| apellidopat) AS usuario,usuarios.foto,usuarios.clave from personas,usuarios where usuarios.id='$id' and usuarios.idpersona=personas.id"));
if(pg_num_rows($consulta)>0):
            $mensajeok=true;
            $Usua=pg_fetch_array($consulta);
            $us=$Usua[0];
            $foto=$Usua[1];
            $clave=$Usua[2];

            echo "<input type='text' id='claveok' value='$clave' class='desvanecer'>";

endif;
?>

<style>
.desvanecer{
    display: none;
}

</style>

<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>

<script type="text/javascript">

$(document).ready(function(){
    $("#login").on("click",function(){
        var ok = $('#claveok').val();
        $('#load').html("<img src='dist/img/indicator.gif'");


      if($('#clave').val()==""){
        //alert("campo contraseña es requerido para iniciar sesión")
        $("#errorC").fadeIn(2000);
        $('#errorC').fadeOut(1000);
      }
      else if($('#clave').val()==ok){
       window.location='admin.php';
      }else{
        //alert("contraseña Incorrecta");

          $("#errorC2").fadeIn(2000);
          $('#errorC2').fadeOut(1000);

      }
    });
});

</script>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>El Tomate | Bloqueo</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!--ICONO DE LA PAGINA -->
    <link rel="shortcut icon" href="dist/img/ICONO.png">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition lockscreen">
    <!-- Automatic element centering -->
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href=""><b>El Tomate </b>Bloqueo</a>
      </div>
      <!-- User name -->
      <div class="lockscreen-name"><?php echo $us?></div>

      <!-- START LOCK SCREEN ITEM -->
      <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
        <?php echo "<img src='$foto'  alt='User Image'>" ?>
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->

          <div class="input-group lockscreen-credentials">
            <input type="password" id="clave" class="form-control" placeholder="Contraseña">
            <div class="input-group-btn">
              <button type="button" class="btn" id="login"><i class="fa fa-arrow-right text-muted"></i></button><div id="load"></div>

              </div>
            </div>
          </div>

      </div><!-- /.lockscreen-item -->
      <div class="help-block text-center">
        Ingrese su contraseña para recuperar su sesión
     </div>
      <div class="text-center">
        <a id="btn_salir">O Inicia Sesión como un Usuario Diferente</a>
      </div>
      <div class="lockscreen-footer text-center">
         <strong>Copyright &copy; 2015 <a href="http://efood.com">Efood</a>.</strong> <br>All rights reserved.
       </div>
    </div><!-- /.center -->
    <br>
    <div class="row " >
    <div class="col-lg-6"></div>
    <div class="col-lg-6">
               <div class="alert alert-info alert-dismissable desvanecer" id="mensajeLogin" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle"> <strong> Bienvenido Usuario </strong></i>
              </div>
              <div class="alert alert-danger desvanecer" id="errorC2" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle"> <strong> Contraseña Incorrecta </strong></i>
              </div>
              <div class="alert alert-danger desvanecer" id="errorC" >
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle"> <strong> Por Favor Ingrese una Contraseña </strong></i>
              </div>

          </div>
    </div>
    <!-- jQuery 2.1.4 -->
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/funciones/jsfunciones.js"></script>
  </body>
</html>
