<?php

use App\Models\Priority;
use Illuminate\Database\Seeder;

class PriorityTableSeeder extends Seeder
{
    private $priority;

    private $priorities = [
        'low' => '#3498db',
        'normal' => '#2ecc71',
        'high' => '#e67e22',
        'urgent' => '#e74c3c'
    ];

    public function __construct(Priority $priority)
    {
        $this->priority = $priority;
    }

    public function run()
    {
        foreach ($this->priorities as $priority => $color) {
            $this->priority->create([
                'priority' => $priority,
                'color' => $color
            ]);
        }
    }
}
