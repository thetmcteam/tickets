<?php

use Illuminate\Database\Seeder;
use App\Contracts\Repositories\DepartmentRepositoryInterface;

class DepartmentsTableSeeder extends Seeder
{
    private $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function run()
    {
        $this->departmentRepository->create([
            'department' => 'global',
            'color' => '#c0392b',
            'public' => 1
        ]);
    }
}
