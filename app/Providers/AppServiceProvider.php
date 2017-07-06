<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(\App\Contracts\Repositories\TypeRepositoryInterface::class, \App\Repositories\TypeRepository::class);
        $this->app->bind(\App\Contracts\Repositories\NoteRepositoryInterface::class, \App\Repositories\NoteRepository::class);
        $this->app->bind(\App\Contracts\Repositories\ActionRepositoryInterface::class, \App\Repositories\ActionRepository::class);
        $this->app->bind(\App\Contracts\Repositories\TicketRepositoryInterface::class, \App\Repositories\TicketRepository::class);
        $this->app->bind(\App\Contracts\Repositories\CommentRepositoryInterface::class, \App\Repositories\CommentRepository::class);
        $this->app->bind(\App\Contracts\Repositories\DepartmentRepositoryInterface::class, \App\Repositories\DepartmentRepository::class);
    }
}
