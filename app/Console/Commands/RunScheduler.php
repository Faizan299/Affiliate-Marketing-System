<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class RunScheduler extends Command
{
    protected $signature = 'run:scheduler';
    protected $description = 'Run the Laravel scheduler';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Artisan::call('schedule:run');
    }
}
