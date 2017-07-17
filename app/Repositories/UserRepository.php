<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Validation\Factory as Validator;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $user;
    private $hasher;
    private $validator;

    public function __construct(User $user, Validator $validator, BcryptHasher $hasher)
    {
        $this->user = $user;
        $this->hasher = $hasher;
        $this->validator = $validator;
    }

    public function findById(int $id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    public function findByUsername($username)
    {
        $user = $this->user->where('username', $username)->first();
        return $user;
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $user = $this->user->create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => $this->hasher->make($data['password']),
            'email' => $data['email']
        ]);

        return $user;
    }

    public function delete(int $id)
    {
        $user = $this->user->find($id);
        
        if (!is_null($user)) {
            $user->delete();
        }
    }

    private function validate(array $data)
    {
        return $this->validator->make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:30',
            'email' => 'nullable|email',
            'password' => 'required|max:60',
        ]);
    }
}