var app = require('http').createServer(handler),
  io = require('socket.io').listen(app),
  fs = require('fs'),
  pg = require('pg'),
  connectionsArray = [],
  connection = new pg.Client('postgres://postgres:postgres@localhost:5432/efood'),
  POLLING_INTERVAL = 2000,
  pollingTimer;
var ruc_=0;
// If there is an error connecting to the database
connection.connect(function(err) {
// connected! (unless `err` is set)
if (err) {
  console.log(err);
}
});

// creating the server ( localhost:2015 )
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
  var query = connection.query('Select pedido.id,mesa.numero_mesa,mesa.estado,pedido.totalpagado from pedido,mesa where pedido.idmesa=mesa.id' ),
  cata = []; // this array will contain the result of our db query
  //console.log(query);

  // setting the query listeners
  query
    .on('error', function(err) {
      // Handle error, and 'end' event will be emitted after this as well
      console.log(err);
      updateSockets(err);
    })
    .on('row', function(row, result) {
      // it fills our array looping on each user row inside the db
      //cata.push(user);
      cata.push(row)
      //console.log(cata);
    })
    .on('end', function() {
      // loop on itself only if there are sockets still connected
      if (connectionsArray.length) {

        pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);

        updateSockets({
          cata: cata
        });
      } else {

        console.log('The server timer was stopped because there are no more socket connections on the app')

      }
    });
};


// creating a new websocket to keep the content updated without any AJAX request
io.sockets.on('connection', function(socket) {
  socket.on('recibirDatos', function(data) {
    ruc_ = data;
  });
  console.log('Number of connections:' + connectionsArray.length);
  // starting the loop only if at least there is one user connected
  if (!connectionsArray.length) {
    pollingLoop();
  }

  socket.on('disconnect', function() {
    var socketIndex = connectionsArray.indexOf(socket);
    console.log('socketID = %s got disconnected', socketIndex);
    if (~socketIndex) {
      connectionsArray.splice(socketIndex, 1);
    }
  });

  console.log('A new socket is connected!');
  connectionsArray.push(socket);

});

// FUNCION PARA CONSULTAR POR LA TABLA PRODUCTO

var pollingLoop2 = function() {

  // Doing the database query
  var query = connection.query('select * from view_platos_presas' ),
  cata = []; // this array will contain the result of our db query
  //console.log(query);

  // setting the query listeners
  query
    .on('error', function(err) {
      // Handle error, and 'end' event will be emitted after this as well
      console.log(err);
      updateSockets(err);
    })
    .on('row', function(row, result) {
      // it fills our array looping on each user row inside the db
      //cata.push(user);
      cata.push(row)
      //console.log(cata);
    })
    .on('end', function() {
      // loop on itself only if there are sockets still connected
      if (connectionsArray.length) {

        pollingTimer = setTimeout(pollingLoop, POLLING_INTERVAL);

        updateSockets({
          cata: cata
        });
      } else {

        console.log('The server timer was stopped because there are no more socket connections on the app')

      }
    });
};
/// FIN DE LA FUNCION PARA BUSCAR EN LA TABLA PRODUCTO

var updateSockets = function(data) {
  // adding the time of the last update
  data.time = new Date();
  console.log('Pushing new data to the clients connected ( connections amount = %s ) - %s', connectionsArray.length , data.time);
  // sending new data to all the sockets connected
  connectionsArray.forEach(function(tmpSocket) {
    tmpSocket.volatile.emit('notification', data);
  });
};


console.log('Please use your browser to navigate to http://localhost:2015');
