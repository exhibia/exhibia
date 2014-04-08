// Require HTTP module (to start server) and Socket.IO
var http = require('http'), io = require('socket.io'), fs = require('fs');
/*, mysql = require("db-mysql");
new mysql.Database({
    "hostname": "localhost",
    "user": "root",
    "password": "Apor80@Ross",
    "database": "webchat"
}).connect(function(error) {
    if (error) {
        return console.log("CONNECTION error: " + error);
    }
    this.query()
        .select(["id", "user", "email"])
        .from("users")
        .where("role IN ?", [ ["administrator", "user"] ])
        .and("created > ?", [ new Date(2011, 1, 1) ])
        .execute(function(error, rows, columns){
            if (error) {
                console.log('ERROR: ' + error);
                return;
            }
            // Do something with rows & columns
        });
});*/
// Start the server at port 8080
var server = http.createServer(function(req, res){ 
		
});
server.listen(8080);

// Create a Socket.IO instance, passing it our server
var socket = io.listen(server);

var interval = 500;
var users = {};
var userNumber = 1;

function getUsers () {
   var userNames = [];
   for(var name in users) {
     if(users[name]) {
       userNames.push(name);
     }
   }
   return userNames;
}
                  function tryParseJSON (jsonString){
  
			  try {
			      var o = JSON.parse(jsonString);

			      // Handle non-exception-throwing cases:
			      // Neither JSON.parse(false) or JSON.parse(1234) throw errors, hence the type-checking,
			      // but... JSON.parse(null) returns 'null', and typeof null === "object", 
			      // so we must check for that, too.
			      if (o && typeof o === "object" && o !== null) {
				  return true;
			      }
			  }
			  catch (e) { }

			  return false;
		};

// Add a connect listener
socket.on('connection', function(socket){ 

  //io.socket.emit('listing', getUsers());
  
  
	      var read_json = function(){
		try{
		setInterval(function(){
		 
		    file=  fs.readFileSync('update_results.json','utf8')
		   
		    if(tryParseJSON (file) == true){
		      socket.send(file);
		    }
		}, interval);
		}catch(error){}
	      }	
	    
				read_json()
				 
	/*		  socket.on("chat", function(data){
				if(data.session == true & data.user_message == true){
					query()
					.insert(["id", "user", "recipient", "user_message"])
					.into("messages")
					
					.execute(function(error, rows, columns){
					    if (error) {
						console.log('ERROR: ' + error);
						return;
					 }
					    // Do something with rows & columns
			           });
				}
				    query().
				      select(["id"])
				      .from(["user"])
				      .where('userid = ?', [ data.recipient ])
				      .join("messages m on m.recipient= ? and userid = ?", [data.recipient, data.userid])
				      .execute(function(error, rows, columns){
					    if (error) {
						console.log('ERROR: ' + error);
						return;
					     }else{
						if(rows.length > 0){
						  messages = '';
						  rows.message.each( function(message){
						    messages += message;
						  }
						 if(messages.length >0 ){
						  socket.emit('chat', myName + ': ' + messages, function(data){
						    
						    
						  });
						}  
					    }
					       
					 }
					     }
				   });
			    });*/
	   
    // Success!  Now listen to messages to be received
	             socket.on('message', function(data){ 
			
				read_json()
		    });	
	   
	socket.on('disconnect',function(){
		clearInterval(interval);
		console.log('Server has disconnected');
	
	/*	  users[myName] = null;
		  io.sockets.emit('listing', getUsers());*/
	});
 });




