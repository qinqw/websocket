var wsUri = "ws://127.0.0.1:9502";
var ws = new WebSocket(wsUri); 
ws.onopen = function(evt) { 
    onOpen(evt) 
}; 
ws.onclose = function(evt) { 
    onClose(evt) 
}; 
ws.onmessage = function(evt) { 
    onMessage(evt) 
}; 
ws.onerror = function(evt) { 
    onError(evt) 
}; 

function onOpen(evt) { 
    console.log("CONNECTED"); 
    console.log("WebSocket rocks"); 
}  

function onClose(evt) { 
    console.log("DISCONNECTED"); 
}  

function onMessage(evt) { 
    console.log(evt.data); 
    //websocket.close(); 
}  

function onError(evt) { 
    console.log(evt.data); 
}