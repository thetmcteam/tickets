<?php

namespace App\Providers;

use App\Repositories\NoteRepository;
use App\Repositories\TicketRepository;
use App\Repositories\CommentRepository;
use App\Contracts\NoteRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
    }
}
