<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AppInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the application migrations and database seeders.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->call('config:cache');
        $this->call('key:generate');
        $this->call('db:seed');
    }
}
