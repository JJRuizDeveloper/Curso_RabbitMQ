<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false,false, false);

echo "Waiting... \n";


$callback = function ($msg) {
    echo ' Received ', $msg->body, "\n";
    sleep(substr_count($msg->body, '.'));
    echo " Done \n";
};


$channel->basic_qos(null, 1, null);
$channel->basic_consume('hello', '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();

?>