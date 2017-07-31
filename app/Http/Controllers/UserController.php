<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Exceptions\UserNotFoundException;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Repositories\InviteRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;
    private $inviteRepository;

    public function __construct(UserRepositoryInterface $userRepository, InviteRepositoryInterface $inviteRepository)
    {
        $this->userRepository = $userRepository;
        $this->inviteRepository = $inviteRepository;

        $this->middleware('admin', [
            'except' => ['store', 'show', 'edit']
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

        $this->inviteRepository->delete($request->get('token'));

        return response(['message' => 'user created.'], 200);
    }

    public function edit()
    {
        $user = Auth::user();
        return view('user.edit')->withUser($user);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->userRepository->update($id, $request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage), 422);
        } catch (UserNotFoundException $e) {
            abort(404);
        }

        return response(['message' => 'user updated.'], 200);
    }

    public function updatePassword(Request $request, $id)
    {
        try {
            $this->userRepository->updatePassword($id, $request->get('password'));
        } catch (UserNotFoundException $e) {
            abort(404);
        }

        return response(['message' => 'user updated.'], 200);
    }

    public function show()
    {
        $user = Auth::user();
        return view('user.profile')->withUser($user);
    }
}
