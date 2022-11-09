<?php

namespace App\Console\Commands;

use App\Jobs\UserCreated;
use Illuminate\Console\Command;

class UserJobCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:created';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exampleUser = [
            'name' => 'Juanjo',
            'email' => 'example@example.com'
        ];

        //dispatch('example')->onQueue('myQueue');
        // If we are using a collection retrieved from Laravel Model, we need to apply ->toArray();
        UserCreated::dispatch($exampleUser);
    }
}
