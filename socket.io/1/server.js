var io = require('socket.io'); var fs = require('fs'); var express = require('express');
var app = express.createServer();
app.configure(function(){  
    });
    app.get('/', function(req, res, next){  res.render('./update_results.json');});
app.listen(8080);

var socket = io.listen(app, {  
    flashPolicyServer: false,  
    transports: ['websocket']});
var allClients = 0;
var clientId = 1;
socket.on('connection', function(client) {  var my_timer;  var my_client = { "id": clientId, "obj": client };
  clientId += 1;
  allClients += 1;
  my_timer = setInterval(function () {    
    my_client.obj.send( fs.readFile('update_results.json') );  }, 1000);  
    client.on('message', function(data) {    my_client.obj.broadcast(JSON.stringify({ message: "poke send by client "+my_client.id }));    
    console.log(data);  
 });

client.on('disconnect', function() {    
    clearTimeout(my_timer);    
    allClients -= 1;    
    console.log('disconnect');  });});