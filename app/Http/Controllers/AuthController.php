<?php

namespace App\Http\Controllers;

use Auth, Adldap;
use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\UserRepositoryInterface;

class AuthController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials['active'] = 1;

        if (Auth::attempt($credentials, false)) {
            return response(['message' => 'login success.'], 200);
        }

        return response(['message' => 'unauthorized.'], 401);
    }

    public function authenticateAgainstAD(Request $request)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $user = $this->userRepository->findByUsername($username);

        if (!empty($user)) {
            return $this->authenticate($request);
        }

        if (Adldap::auth()->attempt($username, $password)) {
            $adUserModel = Adldap::search()->where('samaccountname', $username)->get()->first();
            try {
                $user = $this->userRepository->create([
                    'name' => $adUserModel->getName(),
                    'username' => $username,
                    'email' => $adUserModel->getEmail(),
                    'password' => $password,
                    'admin' => 0
                ]);
            } catch (ValidationException $e) {
                return response(json_decode($e->getMessage()), 422);
            }
        } else {
            return response(['message' => 'unauthorized.'], 401);
        }

        Auth::login($user);
        return response(['message' => 'login success.'], 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
