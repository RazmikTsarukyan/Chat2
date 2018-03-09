var io = require('socket.io')(6001);

io.on('connection', function(socket){
	console.log("New conection",socket.id);

	//  

	//socket.emit('server-info',{version: .1}); 

	//socket.broadcast.send("New user");

	//socket.on('message', function(data){
	//	socket.broadcast.send(data); 
	//});
	

	socket.on('message', function(data){
		socket.broadcast.send(data);
	});

});