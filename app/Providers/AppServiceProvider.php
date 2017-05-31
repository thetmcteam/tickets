<?php

namespace App\Providers;

use App\Repositories\TypeRepository;
use App\Repositories\NoteRepository;
use App\Repositories\TicketRepository;
use App\Repositories\CommentRepository;
use App\Repositories\DepartmentRepository;
use App\Contracts\Repositories\NoteRepositoryInterface;
use App\Contracts\Repositories\TypeRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Contracts\Repositories\DepartmentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
    }

    public function register()
    {
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(NoteRepositoryInterface::class, NoteRepository::class);
        $this->app->bind(TicketRepositoryInterface::class, TicketRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);
    }
}
