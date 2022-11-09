<?php

namespace App\Console\Commands;

use App\Jobs\ExampleJob;
use Illuminate\Console\Command;

class ExampleJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'example:rabbit';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'RabbitMQ Test Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       ExampleJob::dispatch();
    }
}
