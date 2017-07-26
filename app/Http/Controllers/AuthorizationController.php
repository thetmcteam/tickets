<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\AuthorizationRepositoryInterface;

class AuthorizationController extends Controller
{
    private $authorizationRepository;

    public function __construct(AuthorizationRepositoryInterface $authorizationRepository)
    {
        $this->middleware('admin');
        $this->authorizationRepository = $authorizationRepository;
    }

    public function show($id)
    {
        $authorizations = $this->authorizationRepository->findById($id);
        return response($authorizations);
    }

    public function store(Request $request)
    {
        try {
            $this->authorizationRepository->create($request->all());
        } catch (ValidationException $e) {
            $errors = json_decode($e->getMessage());
            return response($errors, 422);
        }

        return response(['message' => 'authorization created.'], 200);
    }

    public function delete($id)
    {
        $this->authorizationRepository->delete($id);
        return response(['message' => 'authorization deleted.'], 200);
    }
}
