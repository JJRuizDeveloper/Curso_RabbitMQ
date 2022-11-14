<?php

require_once __DIR__ .'/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('topic_logs', 'topic', false, false, false);

list($queue_name, ,) = $channel->queue_declare("", false, false, false, false);


/* warning.created.topic1.topic2.topic3.topicN  */
/*  * = Word
    # = N words
*/ 

$binding_keys = array_slice($argv, 1);

if(empty($binding_keys)) {
    file_put_contents('php://stderr', "Usage: $argv[0] [binding_key] \n");
    exit(1);
}

foreach ($binding_keys as $binding_key) {
    $channel->queue_bind($queue_name, 'topic_logs', $binding_key);
}

echo 'Waiting... \n';

$callback = function ($msg) {
    echo $msg->delivery_info['routing_key'], '----', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_open()) {
    $channel->wait();
}

$channel->close();
$connection->close();
?>
