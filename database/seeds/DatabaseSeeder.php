<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(TypesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(StatusTableSeeder::class);
        $this->call(PriorityTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
    }
}
