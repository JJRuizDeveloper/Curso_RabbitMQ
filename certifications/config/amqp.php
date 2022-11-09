<?php

use App\Actions\AmqpConsumers\ConsumeUser;

return [
  /******************************************************************************
   * Broker connection settings
   *****************************************************************************/
  'connections'     => [
    'rabbitmq' => [
      'host'     => env('RABBITMQ_HOST', 'localhost'),
      'port'     => env('RABBITMQ_PORT', 7077),
      'username' => env('RABBITMQ_USER', ''),
      'password' => env('RABBITMQ_PASSWORD', ''),
      'vhost'    => env('RABBITMQ_VHOST', '/'),
    ],
  ],

  /******************************************************************************
   * Change broker to use
   * At the moment only RabbitMQ is implemented
   *****************************************************************************/
  'broker'          => 'Altra\Amqp\Connections\RabbitMQConnection',
  'publisher'       => 'Altra\Amqp\Publishers\RabbitPublisher',
  'consumer'        => 'Altra\Amqp\Consumers\RabbitConsumer',

  /******************************************************************************
   * Consumable queue
   *****************************************************************************/
  'queue'           => env('RABBIT_QUEUE_NAME'),

  /******************************************************************************
   * Consumable Actions
   *****************************************************************************/

  'consume_actions' => [
    'User' => ConsumeUser::class,
  ],
];
