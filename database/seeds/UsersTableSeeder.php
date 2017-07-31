<?php

use Illuminate\Database\Seeder;
use Illuminate\Hashing\BcryptHasher;
use App\Contracts\Repositories\UserRepositoryInterface;

class UsersTableSeeder extends Seeder
{
    private $hasher;
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository, BcryptHasher $hasher)
    {
        $this->hasher = $hasher;
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        $this->userRepository->create([
            'name' => 'administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => $this->hasher->make('secret'),
            'admin' => 1
        ]);
    }
}
