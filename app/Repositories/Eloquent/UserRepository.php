<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Validation\Factory as Validator;
use App\Exceptions\ValidationException;
use App\Exceptions\UserNotFoundException;
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

    public function getAll()
    {
        $users = $this->user->all();
        return $users;
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
        $validator = $this->validator->make($data, [
            'name' => 'required|max:255',
            'username' => 'required|max:30|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|max:60',
            'admin' => 'required|in:0,1',
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $user = $this->user->create([
            'name' => $data['name'],
            'username' => $data['username'],
            'password' => $this->hasher->make($data['password']),
            'email' => $data['email'],
            'admin' => $data['admin'],
        ]);

        return $user;
    }

    public function update(int $id, array $data)
    {
        $validator = $this->validator->make($data, [
            'name' => 'required|max:255',
            'image' => 'required|url'
        ]);

        if ($validator->fails()) {
            throw new DisplayValidationException(json_encode($validator->errors()->all()));
        }

        $user = $this->user->find($id);

        if (is_null($user)) {
            throw new UserNotFoundException('No user found by the requested id.');
        }

        $user->name = trim(strtolower($data['name']));
        $user->image = trim($data['image']);
        $user->save();
    }

    public function updatePassword(int $id, $password)
    {
        $user = $this->user->find($id);

        if (is_null($user)) {
            throw new UserNotFoundException('No user was found by the requested id.');
        }

        $user->password = $this->hasher->make($password);
        $user->save();
    }

    public function activate(int $id)
    {
        $user = $this->user->find($id);

        if (!is_null($user)) {
            $user->activate();
        }
    }

    public function delete(int $id)
    {
        $user = $this->user->find($id);
        
        if (!is_null($user)) {
            $user->deactivate();
        }
    }
}
