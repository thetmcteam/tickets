<?php

namespace App\Providers;

use App\Repositories\TicketRepository;
use App\Contracts\Repositories\TicketRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
    }
}
