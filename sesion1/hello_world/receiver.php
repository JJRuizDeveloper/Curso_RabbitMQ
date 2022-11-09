<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->queue_declare('hello', false, false, false, false);

echo "Waiting messages...\n";


// 1. Declare consume callback
$callback = function ($msg) {
    echo "Message received ", $msg->body, "\n";
};

// 2. Declare the consume
$channel->basic_consume('hello', '', false, true, false, false, $callback);


// 3. Keep the consumer waiting until the 'Channel Destroy'
while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();

?>