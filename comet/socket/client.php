<html>
	<head>
	<!--
	 * Author:		Gianluca Guarini
	 * Contact: 	gianluca.guarini@gmail.com
	 * Website:		http://www.gianlucaguarini.com/
	 * Twitter:		@gianlucaguarini
	-->
		<title>Push notification server streaming on a MySQL db</title>
		<style>
			dd,dt {
				float:left;
				margin:0;
				padding:5px;
				clear:both;
				display:block;
				width:100%;

			}
			dt {
				background:#ddd;
			}
			time {
				color:gray;
			}
		</style>
	</head>
	<body>
        <time></time>
        <div id="container">Loading ...</div>
    <script src="socket.io/socket.io.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>

        // create a new websocket
        var socket = io.connect('http://localhost:8000');
        // on message received we print all the data inside the #container div
				ruc="1313210971001"
				socket.emit("recibirDatos", ruc);
        socket.on('notification', function (data) {
        var usersList = "<dl>";
        $.each(data.cata,function(index,user){
            usersList += "<dt>" + user.fecha + "</dt>\n" +
                         "<dd>" + user.total + "\n" +
                         "</dd>";
        });
        usersList += "</dl>";
        $('#container').html(usersList);

        $('time').html('Last Update:' + data.time);
      });
    </script>
    </body>
</html>
