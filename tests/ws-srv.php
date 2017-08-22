<?php
namespace tests;
require_once 'bootstrap.php';

use qinqw\wsocket\Server;

$srv = new Server();
$srv->start();