<?php

namespace App\Listeners;

use Altra\Amqp\Facades\Amqp;

class PublishUser
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle($event)
  {
    $exchange   = $event->exchange;
    $routingKey = $event->exchange['exchange'];
    Amqp::publish(json_encode($event->userData), $exchange, $routingKey);
  }
}
