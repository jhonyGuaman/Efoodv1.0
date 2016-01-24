var _esN = window.navigator.appName=='Netscape' ? true : false;
var _esIE = window.navigator.appName=='Microsoft Internet Explorer' ? true : false;
var jsonRes;
var text_load;


//FUNCION PARA CREAR EL COMBO SECO 2
    $(document).ready(function() {
      $('select#cmb_seco1').on('change',function(){
        var idS =$(this).val();
        $.ajax({
          type:"POST",
          url:'includes/crear_cmbseco2.php',
          data:{idS:idS},
          success:function(response){
            $("#seco2").html(response);
          }
        });
      });
    });


    //FUNCION PARA CREAR EL COMBO CALDO 2

    $(document).ready(function() {
      $('select#cmb_caldo1').on('change',function(){
        var idC =$(this).val();
        //     document.cookie ='var='+idC;
        $.ajax({
          type:"POST",
          url:'includes/crear_cmbCaldo2.php',
          data:{idC:idC},
          success:function(response){
            $("#caldo2").html(response);
          }
        });
      });
    });
    //FUNCION PARA ELIMNAR ITEM DEL COMBO CALDO2

    function delete_itemC2(valor){
      alert(valor);
      $("#cmb_caldo2").find("option[value='valor']").remove();
    }

    /////////////////////////////////////////////////////////

    // FUNCIONES PARA ACTUALIZAR ELIMINAR TIPO CANTIDAD
    function actualizar_tipoCantidad(id){
      //divResultado = document.getElementById('lista1');
      $.ajax({
        url:'platos/consulta_tipocantId.php',
        type:'POST',
        dataType:"json",
        data:{id:id},
        success:function(response){
          $('#id_update').val(response.Rid);
          $('#idlib').val(response.Rid);
          $('#categoria_update').val(response.Rtipo);
        }
      });
    }

    function guardar_update_tipoCantidad(){
      //var $id2=$('#id_update').val();
      //var $categoria=$('#categoria_update').val();
      var datosform=$("#formLibro").serialize();
      $.ajax({
        url:'platos/update_tipocant.php',
        type:'POST',
        data:datosform,
        success:function(response){
          $('#exito').show();
          $('#lista1').html(response);
        }
      });
    }

    function eliminar_tipoCantidad(id){
      divResultado = document.getElementById('lista1');
      var opcionEliminar= confirm("Esta seguro Eliminar el Tipo de plato");
      if (opcionEliminar)
      {
        $.ajax({
          url:'platos/delete_tipocant.php',
          type:'POST',
          data:{id:id},
          success:function(response){
            //alert("Tipo ha sido elimindado correcto");
            $('#lista1').html(response);
            //divResultado.innerHTML = ajax.responseText
          }
        });
      }
    }
    //////////////////////////////////////////////////////////////////////////////////
    /// FUNCIONES PARA ACTULIZAR Y ELIMINAR TIPO DE PLATO
    function guardar_update(){
      //var $id2=$('#id_update').val();
      //var $categoria=$('#categoria_update').val();
      var datosform=$("#formLibro").serialize();
      $.ajax({
        url:'platos/update_tipoplato.php',
        type:'POST',
        data:datosform,
        success:function(response){
          $('#exito').show();
          $('#lista1').html(response);
        }
      });
    }

    function actualizar(id){
      //divResultado = document.getElementById('lista1');
      $.ajax({
        url:'platos/consulta_tipoporId.php',
        type:'POST',
        dataType:"json",
        data:{id:id},
        success:function(response){
          $('#id_update').val(response.Rid);
          $('#idlib').val(response.Rid);
          $('#categoria_update').val(response.Rtipo);
        }
      });
    }


    function eliminar(id){
      divResultado = document.getElementById('lista1');
      var opcionEliminar= confirm("Esta seguro Eliminar el Tipo de plato");
      if (opcionEliminar)
      {
        $.ajax({
          url:'platos/delete_tipoplato.php',
          type:'POST',
          data:{id:id},
          success:function(response){
            //alert("Tipo ha sido elimindado correcto");
            $('#lista1').html(response);
            //divResultado.innerHTML = ajax.responseText
          }
        });
      }
    }

    //////////////////////////////////////////////////////////////////



    $(document).ready(function(){
      $("#btn_tipo").click(function(){
        if($('#tipo').val()=="")
        {
          $('#vacio').fadeIn(500);
          $('#vacio').fadeOut(1000);
          $('#tipo').focus();
        }else {
          var tipo =$('#tipo').val();
          $("#respuesta").html("<img src='dist/img/load.gif'> ");
          $.ajax({
            type:"POST",
            dataType:"json",
            url:'includes/tipocantAjax.php',
            data:{tipo:tipo},
            success:function(response){
              if(response.respuesta==true){
                setTimeout(function(){
                  //  $('.desvanecer2').hide();
                  $('#respuesta').fadeOut(1000);
                  $('#tipo').val("");
                  //$("#respuesta").html(datos);
                },2000);
                $('#mensaje').fadeIn(2000);
                $('#mensaje').fadeOut(1000);
              }else {
                $('#error').fadeIn(2000);
                $('#error').fadeOut(1000);
              }
            }
          });
        }
      });
    });

    $(document).ready(function(){
      $("#btn_categoria").click(function(){
        if($('#categoria').val()=="")
        {
          $('#vacio').fadeIn(1000);
          $('#vacio').fadeOut(1000);
          $('#categoria').focus();
        }else {
          var categoria =$('#categoria').val();
          $("#respuesta").html("<img src='dist/img/load.gif'> ");
          $.ajax({
            type:"POST",
            dataType:"json",
            url:'includes/tipoplatoAjax.php',
            data:{categoria:categoria},
            success:function(response){
              if(response.respuesta==true){
                setTimeout(function(){
                  $('#respuesta').hide();
                  $('#categoria').val("");
                   //$("#lista1").html(response);
                },2000);
                $('#mensaje').fadeIn(2000);
                $('#mensaje').fadeOut(1000);
              }else {
                $('#error').fadeIn(2000);
                $('#error').fadeOut(1000);
              }
            }

          });
        }
      });
    });

    $(document).ready(function(){
      $("#btn_salir").click(function(){
        window.location="salir.php";
      });
    });

    function limpiarClientes(){
      $('#cedula').val("");
      $('#nombre').val("");
      $('#ape_paterno').val("");
      $('#ape_materno').val("");
      $('#telefono').val("");
      $('#direccion').val("");
    }



    function validar(frm) {
      if (frmcliente.cedu.value.length!=9) {
        alert('Codigo del Empleado Imcompleto');
        frmcliente.cedu.focus();
      }
    }

    function solo_numeros(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8 || tecla==9)
      return true;
      patron =/[0-9]/;
      tecla_final = String.fromCharCode(tecla);
      return (patron.test(tecla_final));
    }

    function validar_numeros(e) {
      tecla = e.which || e.keyCode;
      patron = /\d/; // Solo acepta números
      te = String.fromCharCode(tecla);
      return (patron.test(te) || tecla == 9 || tecla == 8);
    }

    function solo_numeros1(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8)
      return true;
      patron =/[1-3]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }


    function solo_monedas(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8)
      return true;
      patron =/[0123456789.]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }

    function solo_fechas(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8)
      return true;
      patron =/[0-9, -]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }

    function solo_letras(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8)
      return true;
      patron =/[A-Z, a-z,ñ,Ñ]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }

    function numeros_letras(e){
      tecla = (document.all) ? e.keyCode : e.which;
      if (tecla==8)
      return true;
      patron =/[A-Z, a-z, 0-9,ñ,Ñ]/;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }

    function valemail(valor){
      re=/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/
      if(!re.exec(valor))    {
        return false;
      }else{
        return true;
      }
    }



    function sumar(x)
    {
      // var yea=document.getElementById("tabla1").rows.length;
      //  alert("fila : "+x);
      //for(var x=0; x<yea ; x++){

      var valor1=verificar("presa"+x+"1");
      //alert("presa"+x+"1");
      var valor2=verificar("presa"+x+"2");
      var valor3=verificar("presa"+x+"3");
      var valor4=verificar("presa"+x+"4");
      // realizamos la suma de los valores y los ponemos en la casilla del
      // formulario que contiene el total
      //}
      //alert(valor1+" "+valor2+" "+valor3+" "+valor4)
      document.getElementById("total"+x+"").value=parseFloat(valor1)+parseFloat(valor2)+parseFloat(valor3)+parseFloat(valor4);
    }
    /**
    * Funcion para verificar los valores de los cuadros de texto. Si no es un
    * valor numerico, cambia de color el borde del cuadro de texto
    */
    function verificar(id)
    {
      var obj=document.getElementById(id);
      if(obj.value=="")
      value="0";
      else
      value=obj.value;
      if(validate_importe(value,1))
      {
        // marcamos como erroneo
        obj.style.borderColor="#808080";
        return value;
      }else{
        // marcamos como erroneo
        obj.style.borderColor="#f00";
        return 0;
      }
    }

    /**
    * Funcion para validar el importe
    * Tiene que recibir:
    *  El valor del importe (Ej. document.formName.operator)
    *  Determina si permite o no decimales [1-si|0-no]
    * Devuelve:
    *  true-Todo correcto
    *  false-Incorrecto
    */
    function validate_importe(value,decimal)
    {
      if(decimal==undefined)
      decimal=0;
      if(decimal==1)
      {
        // Permite decimales tanto por . como por ,
        var patron=new RegExp("^[0-9]+((,|\.)[0-9]{1,2})?$");

      }else{
        // Numero entero normal
        var patron=new RegExp("^([0-9])*$")
      }
      if(value && value.search(patron)==0)
      {
        return true;
      }
      return false;

    }

    function check_cedula( valor ){
      var cedula = valor;
      array = cedula.split( "" );
      num = array.length;
      if ( num == 10 ){
        total = 0;
        digito = (array[9]*1);
        for( i=0; i < (num-1); i++ ){
          mult = 0;
          if ( ( i%2 ) != 0 ) {
            total = total + ( array[i] * 1 );
          }else{
            mult = array[i] * 2;
            if ( mult > 9 )
            total = total + ( mult - 9 );
            else
            total = total + mult;
          }
        }
        decena = total / 10;
        decena = Math.floor( decena );
        decena = ( decena + 1 ) * 10;
        fin = ( decena - total );
        if ( ( fin == 10 && digito == 0 ) || ( fin == digito ) ) {
          return true;
        }else{
          return false;
        }
      }else{
        return false;
      }

    }

    function verificarEntrada(control)
    {
      if (control.value=='')
      alert('Debe ingresar datos');
    }

    function dias_transcurridos($fecha_i,$fecha_f)
    {
      $dias   = (strtotime($fecha_i)-strtotime($fecha_f))/86400;
      $dias   = abs($dias); $dias = floor($dias);
      return $dias;
    }

    ///////////////////////////////////FUNCIONES GLOBALES DEL SISTEMA

    function ajax_cone(div,fun,url,load,noti){
      var ajax = getTransporte();

      ajax.onreadystatechange = function(){
        if(ajax.readyState == 4){
          if(ajax.status==200){
            if(typeof(JSON.parse(ajax.responseText)) != "string" ) {
              //campos_disabled(arrenv,false);
              //campos_disabled(arrenv,false);
              jsonRes=JSON.parse(ajax.responseText);
              if( typeof(fun) != "undefined" ){
                fun();
              }
            }else{
              noti.html(returnyellow("Alerta","vuelva a cargar la página"));
              //  campos_disabled(arrenv,false);
            }
          }else{

            noti.html(returnyellow("Alerta","vuelva a cargar la página y verifique su conexión de internet"));
            div.html(text_load);
            //campos_disabled(arrenv,false);
          }
        }else{
          div.html(load);
          //campos_disabled(arrenv,true);
        }
      };
      ajax.open('POST', url, true);
      ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
      ajax.send(env_form);
      env_form = "";
    }


    function getTransporte() {
      return _esN ? new XMLHttpRequest() : (new
        XObject('Msxml2.XMLHTTP') || new ActiveXObject('Microsoft.XMLHTTP') || false);
      }


      function returngreen(t1,t2){
        return '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><i class="fa fa-check-circle"></i> <strong>'+t1+'</strong> <small>'+t2+'</small>  </div>'
      };
      function returnyellow(t1,t2){
        return '<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><i class="fa fa-exclamation-triangle "></i> <strong>'+t1+'</strong> <small>'+t2+'</small>  </div>'
      };
      function returnred(t1,t2){
        return '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><i class="fa fa-exclamation-triangle"></i> <strong>'+t1+'</strong> <small>'+t2+'</small></div>'
      };
