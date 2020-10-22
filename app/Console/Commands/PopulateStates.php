<?php

namespace App\Console\Commands;

use App\Models\State;
use Illuminate\Console\Command;

class PopulateStates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:states';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populates all states in Nigeria';

    /**
     * Create a new command instance.
     *
     * @return void
     */
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
        $this->info('Populating States...🍉🍉🍉🍉🍉');

        $states = config('states.states');

        foreach ($states as $code => $state) {
          State::firstOrCreate([
            'code' => $code,
            'state' => $state
          ]);
        }

        $this->info('States Populated!🔥');

        return 0;
    }
}
