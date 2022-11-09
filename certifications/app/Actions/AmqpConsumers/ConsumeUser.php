<?php

namespace App\Actions\AmqpConsumers;

use Altra\Amqp\Contracts\ConsumeActionContract;
use Illuminate\Support\Facades\Log;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumeUser implements ConsumeActionContract
{
  public function execute(AMQPMessage $message): void
  {
    Log::info($message->body);
  }
}
