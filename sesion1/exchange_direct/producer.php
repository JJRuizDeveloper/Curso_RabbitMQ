<?php

require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
$channel = $connection->channel();

$channel->exchange_declare('direct_logs', 'direct', false, false, false);
$severity = isset($argv[1]) && !empty($argv[1]) ? $argv[1] : 'warning';

$data = implode(' ', array_slice($argv, 1));
if (empty($data)) {
    $data = "Default message";
}

$msg = new AMQPMessage($data);

$channel->basic_publish($msg, 'direct_logs', $severity);

echo 'Message sent: ', $data, $severity, '\n';

$channel->close();
$connection->close();

?>