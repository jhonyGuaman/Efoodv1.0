select personas.id,cliente.id,personas.nombre,personas.apellidopat,personas.apellidomat,personas.cedula,personas.direccion,personas.telefono from personas,cliente where personas.id =cliente.idpersona;
select usuarios.id,usuarios.username,usuarios.clave,usuarios.foto,personas.nombre,personas.apellidopat,personas.apellidomat,personas.cedula,personas.direccion,personas.telefono from usuarios,personas where personas.id=usuarios.idpersona;

///CONSULTA PARA LOS platos

select platos.id,platos.nombreplato,platos.precio,tipoplato.categoria,tipocantidad.tipo from platos,tipoplato,tipocantidad
where platos.idtipo=tipoplato.id
and   platos.idxcantidad=tipocantidad.id;



// BUSCAR PLATOS Y PRODUCTOS


select platos.nombreplato from platos where platos.nombreplato="Caldo de Chancho";





insert into pedido (idplato,idmesa,idcliente,subtotal,iva,totalpagado)
values(2,4,1,10.20,1.40,11.60);


Select pedido.id,mesa.numero_mesa, mesa.estado, pedido.totalpagado from pedido,mesa where pedido.idmesa=mesa.id



//BUSCAR PLATOS POR TIPO CANTIDAD PRESAS
select platos.id,platos.nombreplato from platos,tipocantidad where platos.idxcantidad=tipocantidad.id and platos.idxcantidad=1

//BUSCAR PLATOS POR TIPO CANTIDAD PLATOS
select platos.id,platos.nombreplato from platos,tipocantidad where platos.idxcantidad=tipocantidad.id and platos.idxcantidad=2



/// vista bebidas

		select platos.id,platos.nombreplato,platos.precio,bebidas.cantidad,tipoplato.categoria,platos.dias_disponibles from platos,bebidas,tipoplato 
		where platos.id=bebidas.idplato and tipoplato.id=platos.idtipo




//////////////////// validacion de cedula js////////////////////////////////////

function check_cedula( form )
{
  var cedula = form.cedula.value;
  array = cedula.split( "" );
  num = array.length;
  if ( num == 10 )
  {
    total = 0;
    digito = (array[9]*1);
    for( i=0; i < (num-1); i++ )
    {
      mult = 0;
      if ( ( i%2 ) != 0 ) {
        total = total + ( array[i] * 1 );
      }
      else
      {
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
    final = ( decena - total );
    if ( ( final == 10 && digito == 0 ) || ( final == digito ) ) {
      alert( "La c\xe9dula ES v\xe1lida!!!" );
      return true;
    }
    else
    {
      alert( "La c\xe9dula NO es v\xe1lida!!!" );
      return false;
    }
  }
  else
  {
    alert("La c\xe9dula no puede tener menos de 10 d\xedgitos");
    return false;
  }
}
////////////////////////////////////////////////////////////////////////
