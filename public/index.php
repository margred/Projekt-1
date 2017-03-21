<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use HAWMS\Application;
use HAWMS\http\Server;
use HAWMS\http\ServerContext;

$context = new ServerContext();
$application = new Application();
$server = new Server($context, $application);
$server->run();
