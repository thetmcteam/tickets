<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\InviteRepositoryInterface;

class InviteController extends Controller
{
    private $inviteRepository;

    public function __construct(InviteRepositoryInterface $inviteRepository)
    {
        $this->inviteRepository = $inviteRepository;

        $this->middleware('invite.pending', [
            'only' => ['index']
        ]);
    }

    public function index(Request $request)
    {
        $uuid = $request->get('token');
        $invite = $this->inviteRepository->findByUuid($uuid);
        return view('user.invite')->withInvite($invite);
    }

    public function store(Request $request)
    {
        if ($this->inviteRepository->existsForEmail($request->get('email'))) {
            return response(['error' => 'invite pending.'], 422);
        }

        try {
            $invite = $this->inviteRepository->create($request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 422);
        }

        $invite->notify(new \App\Notifications\Invited($invite, config('app.name')));

        return response(['message' => 'invite created.'], 200);
    }
}
