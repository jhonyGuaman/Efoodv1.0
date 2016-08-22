function notificar(titulo, mensaje){
PNotify.desktop.permission();
(new PNotify({
  title: titulo,
  text: mensaje,
  desktop: {
  desktop: true,
  icon: 'dist/img/mesa.png'
}
})).get().click(function(e) {
if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
//alert('Hey! You clicked the desktop notification!');
cambiarcont('movimiento_mesa.php');
});

}

function notificarPedido(titulo, mensaje){
PNotify.desktop.permission();
(new PNotify({
  title: titulo,
  text: mensaje,
  desktop: {
  desktop: true,
  icon: 'dist/img/pedido.png'
}
})).get().click(function(e) {
if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
cambiarcont('movimiento_mesa.php');
});

}

function notificarRplato(titulo, mensaje){
PNotify.desktop.permission();
(new PNotify({
  title: titulo,
  text: mensaje,
  desktop: {
  desktop: true,
  icon: 'dist/img/pedido.png'
}
})).get().click(function(e) {
if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
//alert('Hey! You clicked the desktop notification!');
});

}

var stack_bottomright = {"dir1": "up", "dir2": "left", "firstpos1": 300, "firstpos2": 400};

function show_stack_bottomright(type) {
    var opts = {
        title: "Over Here",
        text: "Check me out. I'm in a different stack.",
        addclass: "stack-bottomright",
        delay: 3000,
        stack: stack_bottomright

    };
    switch (type) {
    case 'error':
        opts.title = "Error al guardar";
        opts.text = "Error inesperado intente nuevamente por favor!";
        opts.type = "error";
        break;
    case 'info':
        opts.title = "Breaking News";
        opts.text = "Have you met Ted?";
        opts.type = "info";
        break;
    case 'success':
        opts.title = "Bien";
        opts.text = "Se ha guardado de manera correcta";
        opts.type = "success";
        break;
    }
    new PNotify(opts);
}


function show_stack_custom2(type) {
    var opts = {
        title: "Over Here",
        text: "Check me out. I'm in a different stack.",
        addclass: "stack-custom2",
        stack: stack_custom2
    };
    switch (type) {
    case 'error':
        opts.title = "Oh No";
        opts.text = "Watch out for that water tower!";
        opts.type = "error";
        break;
    case 'info':
        opts.title = "Breaking News";
        opts.text = "Have you met Ted?";
        opts.type = "info";
        break;
    case 'success':
        opts.title = "Good News Everyone";
        opts.text = "I've invented a device that bites shiny metal asses.";
        opts.type = "success";
        break;
    }
    new PNotify(opts);
}



function sms_error(sms){
new PNotify({
    title: 'Error ',
    type: 'error',
    text: 'I use effects from Animate.css. Such smooth CSS3 transitions make me feel like butter.',
    animate: {
        animate: true,
        in_class: 'zoomInLeft',
        out_class: 'zoomOutRight'
    }
});

}