<?php
namespace qinqw\wsocket;

class Server
{
    public $serv = null;
    public $reqs = []; //保持客户端的长连接在这个数组里
    public function __construct($port=9502,$ip="0.0.0.0")
	{
        $this->serv = new \swoole_websocket_server($ip, $port);
        //如下可以设置多端口监听
        //$serv = new swoole_websocket_server("0.0.0.0", 9501, SWOOLE_BASE);
        //$serv->addlistener('0.0.0.0', 9502, SWOOLE_SOCK_UDP);
        //$serv->set(['worker_num' => 4]);
        $this->onOpen();
        $this->onMessage();
        $this->onClose();		
    }
    
    public function close()
	{
		$this->serv->close();
    }
    
    public function start()
    {
        $this->serv->start();
    }

    public function onOpen($callback=null)
    {
        $this->serv->on('Open', function($server, $req) {
            global $reqs;
            $reqs[]=$req->fd;
            echo "connection open: ".$req->fd."\n";
            var_dump(count($reqs));//输出长连接数
        });
    }

    public function onMessage($callback=null)
    {
        $this->serv->on('Message', function($server, $frame) {

            $message = $frame->data;
            $sender_fd = $frame->fd;
          
            var_dump($message);
        
          });
    }

    public function onClose($callback=null)
    {
        $this->serv->on('Close', function($server, $fd) {
            echo "connection close: ".$fd."\n";
        });
    }

}
