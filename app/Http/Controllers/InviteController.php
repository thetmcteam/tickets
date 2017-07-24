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
    }

    public function store(Request $request)
    {
        try {
            $invite = $this->inviteRepository->create($request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 400);
        }

        $invite->notify(new \App\Notifications\Invited($invite, config('app.name')));

        return response(['message' => 'invite created.'], 200);
    }
}
