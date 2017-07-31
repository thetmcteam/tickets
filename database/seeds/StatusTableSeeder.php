<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    private $status;
    
    private $statuses = [
        'open' => '#2ecc71',
        'closed' => '#e74c3c',
        'pending' => '#3498db',
        'unresolved' => '#95a5a6'
    ];

    public function __construct(Status $status)
    {
        $this->status = $status;
    }

    public function run()
    {
        foreach ($this->statuses as $status => $color) {
            $this->status->create([
                'status' => $status,
                'color' => $color
            ]);
        }
    }
}
