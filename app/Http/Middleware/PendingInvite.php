<?php

namespace App\Http\Middleware;

use Closure;
use App\Contracts\Repositories\InviteRepositoryInterface;

class PendingInvite
{
    private $inviteRepository;

    public function __construct(InviteRepositoryInterface $inviteRepository)
    {
        $this->inviteRepository = $inviteRepository;
    }

    public function handle($request, Closure $next)
    {
        $uuid = $request->get('token');

        if ($this->inviteRepository->existsForUuid($uuid)) {
            return $next($request);
        }

        if ($request->json()) {
            return response('Unauthorized.', 401);
        }

        return redirect()->route('login');
    }
}
