var lis = "",lis2='',cl ='',con_a=0, con2_a=0,con = 0 ,con2=0 , con3=0,id_p=0;
var link="'movimiento_mesa.php'";
var num_mesa=[];
var socket = io.connect('http://localhost:2015');
var id='1';
socket.emit("recibirDatos", id);
socket.on('notification', function (data) {
  $.each(data.cata,function(index,user){
    if(user.estado==1){
      con2++;
      cl = 'class="bg-visto-pedido"';
      lis += '<li '+cl+'><a href="javascript:cambiarcont('+link+')"><div class="pull-left"><img src="dist/img/new.png" class="img-responsive" alt="" /></div><h4>Nuevo pedido <strong>#'+user.id+'</strong><small>'+user.numero_mesa+'</small></h4><p>'+user.numero_mesa+'</p></a></li>';
      $("#"+user.numero_mesa+"").removeClass("panel panel-green").addClass("panel panel-red");
      $("#estado"+user.numero_mesa).html("Ocupada")
      $("#total"+user.numero_mesa).html(user.totalpagado);
      con++;
      id_p=user.id;
    }else{
       cl='';
       $("#"+user.numero_mesa+"").removeClass("panel panel-red").addClass("panel panel-green");
       $("#estado"+user.numero_mesa).html("Libre");
       $("#total"+user.numero_mesa).html("0,00");

    }
  });
  lis2 ='<li class="header">Tiene '+con2+' pedidos nuevos</li><li><ul class="menu">';
  lis2 +=lis;
  lis2 += '</ul></li><li class="footer"><a href="javascript:cambiarcont('+link+')">ver todos los pedidos</a></li>';
  if (con_a !=con ) {
      $("#li_pedidos").html("");
      $("#li_pedidos").html(lis2);
      if (con2 != 0) {
        var n = id_p;
        //console.log("n vale "+ n);
        //console.log("id_p vale "+ id_p);
        console.log(con2);
        //if (id_p > n) {
          if (con2_a < con2){
            con3 = con2 - con2_a;
            console.log("con3 vale "+ con3);

            if(con3 > 1){
              $("#audio")[0].play();
              notificarPedido("Notificacion Efood Nuevo Pedido","tiene "+con3+" pedidos nuevos");

              //prueba_notificacion("Nuevos pedidos","tiene "+con3+" pedidos nuevos");
            }else{
              $("#audio")[0].play();
              notificarPedido("Nuevo pedido","tiene "+con3+" pedido nuevo");
            }
          }
        //}
        $("#numpedi").addClass("label label-primary")
        $("#numpedi").html(con2);
        $("#numpedi2").addClass("label label-primary")
        $("#numpedi2").html(con2);
      }
  }
  cl='';lis='';con_a = con;con2_a =con2;con = 0;con2=0;con3=0;
});
