<?php

namespace App\Dto;

use Altra\Dto\DataTransfer;

class UserData extends DataTransfer
{
  public function __construct(
    public string $name,
    public string $surname,
  ) {}

  public static function model(): string
  {
    return "";
  }
}
