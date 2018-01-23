<?php

use Illuminate\Database\Seeder;
use App\Contracts\Repositories\UserRepositoryInterface;

class UsersTableSeeder extends Seeder
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        $this->userRepository->create([
            'name' => 'administrator',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'secret',
            'admin' => 1
        ]);
    }
}
