/*var http= require('http');
var pg = require('pg');
var conString="postgres://postgres:postgres@localhost/efood"
var server = http.createServer(function(req, res) {
pg.connect(conString, function(err, client, done){
    var handleError = function(err){
      if(!err) return false;
        if(client){
          done(client);
        }
         res.writeHead(500, {'content-type': 'text/plain'});
      res.end('An error occurred');
      return true;
    };
     client.query('select * from usuarios', function(err, result) {

        // handle an error from the query
        if(handleError(err)) return;

        // return the client to the connection pool for other requests to reuse
        done();
        res.writeHead(200, {'content-type': 'text/plain'});
        res.end('You are visitor number ' + result.rows[0].count);
      });
  });
});*/
var conString = "postgres://postgres:1234@localhost/postgres";
var app = require('http').createServer(handler),
  io = require('socket.io').listen(app),
  fs = require('fs'),
  pg = require('pg'),
  connectionsArray = [],

  connection = pg.createConnection({
    conString
  }),
  POLLING_INTERVAL = 3000,
  pollingTimer;
  var ruc_=0;
  //If there is an error connecting to the database
  connection.connect(function(err) {
  // connected! (unless `err` is set)
  if (err) {
    console.log(err);
  }
});

// creating the server ( localhost:8000 )
app.listen(8000);

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
  //var query = connection.query('SELECT pedidos.fecha,pedidos.id,cliente.nombres,pedidos.estado FROM pedidos,cliente WHERE (pedidos.estado = 0 or pedidos.estado = 1) and pedidos.aceptado = 0 and pedidos.user_cli = cliente.user and pedidos.id_sucur='+ruc_),
  var query = connection.query('SELECT * FROM usuarios'),
    cata = []; // this array will contain the result of our db query

  // setting the query listeners
  query
    .on('error', function(err) {
      // Handle error, and 'end' event will be emitted after this as well
      console.log(err);
      updateSockets(err);
    })
    .on('result', function(user) {
      // it fills our array looping on each user row inside the db
      cata.push(user);
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

var updateSockets = function(data) {
  // adding the time of the last update
  data.time = new Date();
  console.log('Pushing new data to the clients connected ( connections amount = %s ) - %s', connectionsArray.length , data.time);
  // sending new data to all the sockets connected
  connectionsArray.forEach(function(tmpSocket) {
    tmpSocket.volatile.emit('notification', data);
  });
};
