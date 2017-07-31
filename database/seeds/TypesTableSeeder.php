<?php

use Illuminate\Database\Seeder;
use App\Repositories\Eloquent\TypeRepository;
use App\Contracts\Repositories\TypeRepositoryInterface;

class TypesTableSeeder extends Seeder
{
    private $typeRepository;

    private $types = [
        'bug' => '#d35400',
        'unknown' => '#e74c3c',
        'other' => '#3298db'
    ];

    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function run()
    {
        foreach ($this->types as $type => $color) {
            $this->typeRepository->create([
                'type' => $type,
                'color' => $color
            ]);
        }
    }
}
