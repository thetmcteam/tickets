<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('invite.pending', [
            'only' => ['store']
        ]);
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return response($users);
    }

    public function activate($id)
    {
        $this->userRepository->activate($id);
        return response(['message' => 'user activated.']);
    }

    public function deactivate($id)
    {
        $this->userRepository->delete($id);
        return response(['message' => 'user deactivated.']);
    }

    public function store(Request $request)
    {
        try {
            $this->userRepository->create($request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 422);
        }

        return response(['message' => 'user created.'], 200);
    }
}
