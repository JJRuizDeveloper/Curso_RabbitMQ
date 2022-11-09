<?php

namespace App\Events;

use App\Dto\UserData;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserEvent
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $userData;

  /**
   * Create a new event instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->exchange = ['exchange' => 'User', 'type' => 'topic'];

    $this->userData = UserData::fromArray([
        'name' => 'Marco',
        'surname' => 'Perrullo',
    ]);

  }

}
