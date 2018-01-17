<?php

/*
|--------------------------------------------------------------------------
| Application Repositories
|--------------------------------------------------------------------------
|
| This configuration file will represent all the repository interfaces
| that are binded to the implementation. If an interface need to be
| binded to another implementation, update here.
*/

return [
    \App\Contracts\Repositories\UserRepositoryInterface::class => \App\Repositories\Eloquent\UserRepository::class,
    \App\Contracts\Repositories\TypeRepositoryInterface::class => \App\Repositories\Eloquent\TypeRepository::class,
    \App\Contracts\Repositories\NoteRepositoryInterface::class => \App\Repositories\Eloquent\NoteRepository::class,
    \App\Contracts\Repositories\InviteRepositoryInterface::class => \App\Repositories\Eloquent\InviteRepository::class,
    \App\Contracts\Repositories\ActionRepositoryInterface::class => \App\Repositories\Eloquent\ActionRepository::class,
    \App\Contracts\Repositories\TicketRepositoryInterface::class => \App\Repositories\Eloquent\TicketRepository::class,
    \App\Contracts\Repositories\CommentRepositoryInterface::class => \App\Repositories\Eloquent\CommentRepository::class,
    \App\Contracts\Repositories\MetricsRepositoryInterface::class => \App\Repositories\Metrics\MysqlMetricsRepository::class,
    \App\Contracts\Repositories\DepartmentRepositoryInterface::class => \App\Repositories\Eloquent\DepartmentRepository::class,
    \App\Contracts\Repositories\AttachmentRepositoryInterface::class => \App\Repositories\Eloquent\AttachmentRepository::class,
    \App\Contracts\Repositories\AuthorizationRepositoryInterface::class => \App\Repositories\Eloquent\AuthorizationRepository::class,
];
