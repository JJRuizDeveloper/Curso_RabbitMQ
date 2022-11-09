<?php

namespace App\Console\Commands;

use App\Events\UserEvent;
use Illuminate\Console\Command;

class PublishUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        UserEvent::dispatch();
    }
}
