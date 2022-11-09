<?php

require_once __DIR__ .'/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

// 1. Declare the Queue
$channel->queue_declare('hello', false, false, false, false);

// 2. Set the message
$msg = new AMQPMessage('Hello World');

// 3. Public the message
$channel->basic_publish($msg, '','hello');

echo "Message sent";


$channel->close();
$connection->close();

?>