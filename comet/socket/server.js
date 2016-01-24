var app = require('http').createServer(handler),
    io = require('socket.io').listen(app),
    fs = require('fs'),
    pg = require('pg'),
    connectionsArray = [],
    conString = "postgres://postgres:postgres@localhost/efood",
    connection = new pg.Client(conString),
    POLLING_INTERVAL = 3000,
    pollingTimer;

var id="0";
// If there is an error connecting to the database
connection.connect(function(err) {
  // connected! (unless `err` is set)
  if (err) {
    console.log(err);
  }else {
    console.log("Conexion Exitosa a la Base de Datos Efood");
    //console.log(err);

  }
});

// creating the server ( localhost:8000 )
app.listen(2015);

// on server started we can load our client.html page
function handler(req, res) {
  fs.readFile(__dirname + '/client.php', function(err, data) {
    if (err) {
      console.log(err);
      res.writeHead(500);
      return res.end('Error loading client.php');
    }
    res.writeHead(200);
    res.end(data);
  });
}

/*
 *
 * HERE IT IS THE COOL PART
 * This function loops on itself since there are sockets connected to the page
 * sending the result of the database query after a constant interval
 *
 */

var pollingLoop = function() {
  // Doing the database query
  var query = connection.query("SELECT personas.nombre,personas.apellidopat FROM personas,cliente where  personas.id=cliente.idpersona and personas.cedula='"+id+"'"),
    cata = []; // this array will contain the result of our db query
              // setting the query listeners
    query.on('error', function(err) {
      // Handle error, and 'end' event will be emitted after this as well
      console.log(err);
      updateSockets(err);
    });
    .on('result', function(user) {
      // it fills our array looping on each user row inside the db
      cata.push(user);
    });
    .on('end', function() {
      // loop on itself only if there are sockets still connected
      if (connectionsArray.length) {
        pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);
        updateSockets({
          cata: cata
        });
      } else {
        console.log('El temporizador del servidor se detuvo porque no hay más conexiones de socket en la aplicación')
      }
    });
};
// creating a new websocket to keep the content updated without any AJAX request
io.sockets.on('connection', function(socket) {
  socket.on('recibirDatos', function(data) {
    id = data;
    //console.log("valor de id "+id);
  });
  console.log('Número de conexiones:' + connectionsArray.length);
  // starting the loop only if at least there is one user connected
  if (!connectionsArray.length) {
    pollingLoop();
  }

  socket.on('disconnect', function() {
    var socketIndex = connectionsArray.indexOf(socket);
    console.log('socketID = %s desconectado', socketIndex);
    if (~socketIndex) {
      connectionsArray.splice(socketIndex, 1);
    }
  });
  console.log('Un nuevo socket está conectado!');
  connectionsArray.push(socket);
});

var updateSockets = function(data) {
  // adding the time of the last update
  data.time = new Date();
  console.log('Empujar nuevos datos a los clientes conectados ( connections amount = %s ) - %s', connectionsArray.length , data.time);
  // sending new data to all the sockets connected
  connectionsArray.forEach(function(tmpSocket) {
  tmpSocket.volatile.emit('notification', data);
  });
};

console.log('Utilice el navegador para desplazarse a http://localhost:2015');
