<?php

// Enable Publisher confirms

use PhpAmqpLib\Message\AMQPMessage;

$channel = $connection->channel();
$channel->confirm_select();


// 1. Strategy 1: Publish each message individually (sync verification)
while(thereAreMessages ()) 
{
    $data = "RabbitMQ";
    $msg = new AMQPMessage($data);
    $channel->basic_publish($msg, ...);
    $channel->wait_for_pending_acks(5.000);
}


// 2. Strategy 2: Publish in batch

$size = 100;
$message_count = 0;

while(thereAreMessages())
{
    $data = ...;
    $msg = new AMQPMessage($data);
    $channel->basic_publish($msg, ...);
    $message_count++;
    if($message_count === $size)
    {
        $channel->wait_for_pending_acks(5.000);
        $message_count = 0;
    }
}


// 3. Strategy 3: Async confirmation

$channel->set_ack_handler(
    function (AMQPMessage $msg)
    {
         // Message confirmed
    }
);

$channel->set_nack_handler(
    function (AMQPMessage $msg)
    {
         // Message nack-ed
    }
);

?>