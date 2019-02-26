<?php
namespace tests;
require_once 'bootstrap.php';

use qinqw\wsocket\Server;

$evtClose = function($server, $fd){
    
    $sender_fd = $req->fd;
    echo "connection close: ".$fd."\n";
    var_dump($server);
};

$evtMessage = function($server, $frame){
    
    $message = $frame->data;
    $sender_fd = $frame->fd;
    var_dump($message);
};

$evtOpen = function($server, $req){
    global $reqs;
    $reqs[]=$req->fd;
    echo "connection open: ".$req->fd."\n";
    var_dump(count($reqs));//输出长连接数
    var_dump($req);
};

$srv = new Server();
$srv->onOpen($evtOpen);
$srv->onMessage($evtMessage);
$srv->start();
