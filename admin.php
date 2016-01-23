<?php
include_once('conexion/db.php');
//exec("node.cmd");
session_start();
if(isset($_SESSION['id']))
{ $id = $_SESSION['id'];
  $consulta =pg_query($conexion,("Select (nombre||' '|| apellidopat) AS usuario,usuarios.foto from personas,usuarios where usuarios.id='$id' and usuarios.idpersona=personas.id"));
  if(pg_num_rows($consulta)>0):
    $mensajeok=true;
    $Usua=pg_fetch_array($consulta);
    $us=$Usua[0];
    $foto=$Usua[1];
  endif;
?>
  <!-- jQuery 2.1.4 -->
  <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="Controlador/Pnotify.js"></script>

  <script type="text/javascript">
  function cierraNav(){
   alert ("Ud esta abandonando este sitio, su sesion se finalizara");
   }

  $(document).on("ready",function(){
    var fecha = new Date();
    var horaC = "08:00";
    //alert("Día: "+fecha.getDate()+"\nMes: "+(fecha.getMonth()+1)+"\nAño: "+fecha.getFullYear());
    var hora=fecha.getHours()+":"+fecha.getMinutes();
    var arHora1 = hora.split(":");
    var arHora2 = horaC.split(":");
    // Obtener horas y minutos (hora 1)
    var hh1 = parseInt(arHora1[0],10);
    var mm1 = parseInt(arHora1[1],10);

    // Obtener horas y minutos (hora 2)
    var hh2 = parseInt(arHora2[0],10);
    var mm2 = parseInt(arHora2[1],10);

    // Comparar
    if (hh1<hh2 || (hh1==hh2 && mm1<mm2)){
      console.log(hora +" MENOR "+ horaC +"configure la cantidad de los platos y las presas");
      $("#page-wrapper").load('configurar_plato.php');}
      else if (hh1>hh2 || (hh1==hh2 && mm1>mm2))
      console.log(hora+" MAYOR "+ horaC +": ya no puede Ingresar a la configuracion de los productos");
      else
      console.log(hora +" IGUAL "+ horaC +": configure la cnatidad de los platos");
    });

    /// FUNCION PARA CAMBIAR EL CONTENIDO DEL page-wrapper
    function cambiarcont(pagina) {
      $("#page-wrapper").load(pagina);
    }

      function cargar_reporte(pagina){
        var el=document.getElementById('imprimirpdf');
        el.innerHTML="<iframe src="+pagina+" width='100%' height='600px'></iframe>"
      }

    </script>
    <!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Efood | Administración</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
      <link href="css/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
      <!-- Ionicons
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
      <link href="css/ionicons.min.css" rel="stylesheet" type="text/css">
      <!-- Theme style -->
      <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
      <link href="css/sb-admin.css" rel="stylesheet">

      <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
      <link rel="stylesheet" href="plugins/iCheck/all.css">
      <!-- jvectormap -->
      <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
      <!-- Date Picker -->
      <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
      <!--ICONO DE LA PAGINA -->
      <link rel="shortcut icon" href="dist/img/ICONO.png">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

    </head>
    <body class="hold-transition skin-blue sidebar-mini" onunload="cierraNav()">
      <audio id='audio'> <source src='dist/img/noti.mp3' type='audio/mpeg'></audio>
        <div class="wrapper">
          <header class="main-header">
            <!-- Logo -->
            <a href="admin.php" class="logo">
              <!-- mini logo for sidebar mini 50x50 pixels -->
              <span class="logo-mini"><b>:::</b></span>
              <!-- logo for regular state and mobile devices -->
              <span class="logo-lg"><b>Efood</b>-Admin</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
              <!-- Sidebar toggle button-->
              <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
              </a>
              <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                  <!-- Messages: style can be found in dropdown.less-->
                  <!-- Notifications: style can be found in dropdown.less -->
                  <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-bell-o"></i>
                      <span id="numpedi"></span>
                    </a>
                    <ul class="dropdown-menu" id="li_pedidos"></ul>
                  </li>
                  <!-- Tasks: style can be found in dropdown.less -->

                  <!-- User Account: style can be found in dropdown.less -->
                  <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <?php echo "<img src='$foto' class='user-image' alt='User Image'>" ?>

                      <span class="hidden-xs"> <?php echo $us; ?> </span>
                    </a>
                    <ul class="dropdown-menu">
                      <!-- User image -->
                      <li class="user-header">
                        <?php echo "<img src='$foto' class='img-circle' alt='User Image'>" ?>
                        <p>
                          <?php echo $us?> - Administrador
                          <small>Miembro del Octubre 2015</small>
                        </p>
                      </li>
                      <!-- Menu Footer-->
                      <li class="user-footer">
                        <div class="pull-left">
                          <a href="bloqueo.php" class="btn btn-default btn-flat">Bloquear C</a>
                        </div>
                        <div class="pull-right">
                          <a id="btn_salir" class="btn btn-default btn-flat">Salir</a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
          </header>
          <!-- Left side column. contains the logo and sidebar -->
          <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
              <!-- Sidebar user panel -->
              <div class="user-panel">
                <div class="pull-left image">
                  <?php echo "<img src='$foto' class='img-circle' alt='User Image'>" ?>
                </div>
                <div class="pull-left info">
                  <p><?php echo $us ?></p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  <input type="hidden" id="idpedio_txt">
                </div>
              </div>

              <ul class="sidebar-menu">
                <li class="header">MENU NAVEGACIÓN</li>
                <li class="active treeview">
                  <a href="#">
                    <i class="fa fa-opencart"></i><span>Movimiento de mesas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li class="active">
                      <a href="javascript:cambiarcont('movimiento_mesa.php')">
                        <i class="fa fa-circle-o"></i>Control mesas<span class="pull-right" id="numpedi2"></span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-cutlery"></i>
                    <span>Platos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('platos.php')"><i class="fa fa-registered "></i>Registrar platos</a></li>
                    <li><a href="javascript:cambiarcont('admin_platos.php')"><i class="fa fa-circle-o"></i> Administrar platos</a></li>
                    
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-beer"></i>
                    <span>Bebidas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('bebidas_interfaz.php')"> <i class="fa fa-registered "></i>Registrar bebidas</a> </li>
                    <li><a href="javascript:cambiarcont('admin_bebidas.php')"><i class="fa fa-circle-o"></i> Administrar bebidas</a></li>
                    <li><a href="javascript:cambiarcont('productoIndustr.php')"><i class="fa fa-circle-o"></i> Productos Industrializado</a></li>
                    <li><a href="javascript:cambiarcont('productos/admin_industrializa.php')"><i class="fa fa-circle-o"></i> Administrar Productos I.</a></li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:cambiarcont('facturacion.php')">
                    <i class="fa fa-th"></i> <span>Venta directa</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-male"></i>
                    <span>Clientes</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('clientes.php')"><i class="fa fa-registered "></i> Registrar clientes</a></li>
                    <li><a href="javascript:cambiarcont('clientes/administracion_clientes.php')"><i class="fa fa-circle-o"></i> Administrar clientes</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('empleados.php')"><i class="fa fa-registered "></i> Registrar usuarios</a></li>
                    <li><a href="javascript:cambiarcont('usuarios/administracion_usuarios.php')"><i class="fa fa-circle-o"></i> Administrar usuarios</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Mesas</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('configuraciones/mesas.php')"><i class="fa fa-registered "></i> Registrar mesas</a></li>
                    <li><a href="javascript:cambiarcont('configuraciones/actualizarmesas.php')"><i class="fa fa-circle-o"></i> Administrar mes</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Reportes</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('reporte/reporte.php')"><i class="fa fa-print "></i>Ventas realizadas</a></li>
                    <li><a href="javascript:cambiarcont('reporte/estadistica/report_estadistica.php')"><i class="fa fa-line-chart"></i>Platos más vendidos</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Configuraciones</span>
                    <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="javascript:cambiarcont('platos/tipoplato.php')"><i class="fa fa-cog"></i> Registrar categorias</a></li>
                    <li><a href="javascript:cambiarcont('platos/tipocantidad.php')"><i class="fa fa-cog"></i> Registrar unidad de control</a></li>
                    <li><a href="javascript:cambiarcont('configurar_almuerzo.php')"> <i class="fa fa-cogs "></i>Configurar almuerzos</a> </li>
                    <li><a href="javascript:cambiarcont('configurar_plato.php')"> <i class="fa fa-cog"></i>Configurar stock platos</a> </li>
                  </ul>
                </li>
              </section>
              <!-- /.sidebar -->
            </aside>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
              <!-- Content Header (Page header) -->
              <section class="content">
                <?php include_once("movimiento_mesa.php") ?>
              </iframe>
            </div><!-- /.content-wrapper -->
            <footer class="main-footer">
              <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
              </div>
              <strong>Copyright &copy; 2016 <a href="http://efood.com">Efood</a>.</strong> All rights reserved.
            </footer>

          </div><!-- ./wrapper -->
          <!-- jQuery UI 1.11.4
          <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>-->
          <script src="plugins/jquery-ui-1.11.4/jquery-ui.min.js"> </script>
          <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
          <script>
          $.widget.bridge('uibutton', $.ui.button);
          </script>
          <!-- Bootstrap 3.3.5 -->
          <script src="bootstrap/js/bootstrap.min.js"></script>
          <!-- Morris.js charts
          <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
          <script src="plugins/morris/morris.min.js"></script>-->
          <!-- Sparkline -->
          <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
          <!-- jvectormap -->
          <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
          <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
          <!-- jQuery Knob Chart -->
          <script src="plugins/knob/jquery.knob.js"></script>
          <!-- daterangepicker -->
          <script src="plugins/daterangepicker/daterangepicker.js"></script>
          <!-- datepicker -->
          <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
          <!-- Bootstrap WYSIHTML5
          <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->
          <!-- Slimscroll -->
          <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
          <!-- FastClick -->
          <script src="plugins/fastclick/fastclick.min.js"></script>
          <!-- AdminLTE App-->
          <script src="dist/js/app.js"></script>
          <!-- AdminLTE dashboard demo (This is only for demo purposes)
          <script src="dist/js/pages/dashboard.js"></script>-->
          <!-- AdminLTE for demo purposes -->
          <script src="dist/js/demo.js"></script>
          <!-- Select2 -->
          <script src="plugins/select2/select2.full.min.js"></script>
          <!-- InputMask -->
          <script src="plugins/input-mask/jquery.inputmask.js"></script>
          <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
          <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
          <!-- bootstrap color picker -->
          <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
          <!-- bootstrap time picker -->
          <script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
          <!-- iCheck 1.0.1 -->
          <script src="plugins/iCheck/icheck.min.js"></script>
          <!-- JS FUNCIONES GENERALES-->
          <script src="plugins/funciones/jsfunciones.js"></script>
          <!-- Socket PEDIDOS-->
          <script src="Controlador/socket.io.js"></script>
          <script src="https://cdn.socket.io/socket.io-1.3.7.js"></script>
          <!-- JS NOTIFICACIONES-->
          <script src="Controlador/pedidos.js"></script>
          <script src="Controlador/presas_node.js"></script>

          <!--PNotify -->
          <script src="pnotify/pnotify.custom.min.js"> </script>
          <link href="pnotify/pnotify.custom.min.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="pnotify/pnotify.js"></script>
          <link href="pnotify/pnotify.css" rel="stylesheet" type="text/css" />
          <link href="pnotify/pnotify.brighttheme.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="pnotify/pnotify.animate.js"></script>
          <script type="text/javascript" src="pnotify/pnotify.buttons.js"></script>
          <link href="pnotify/pnotify.buttons.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="pnotify/pnotify.confirm.js"></script>
          <link href="pnotify/pnotify.nonblock.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="pnotify/pnotify.nonblock.js"></script>
          <script type="text/javascript" src="pnotify/pnotify.mobile.js"></script>
          <link href="pnotify/pnotify.mobile.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="pnotify/pnotify.desktop.js"></script>
          <script type="text/javascript" src="pnotify/pnotify.history.js"></script>
          <link href="pnotify/pnotify.history.css" rel="stylesheet" type="text/css" />
          <script type="text/javascript" src="pnotify/pnotify.callbacks.js"></script>
          <script type="text/javascript" src="pnotify/pnotify.reference.js"></script>
        </body>
        <?php }   else{  include_once("404.php");  }      ?>
      </html>
