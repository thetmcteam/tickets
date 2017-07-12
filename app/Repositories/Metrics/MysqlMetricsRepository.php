<?php

namespace App\Repositories\Metrics;

use DB;
use App\Contracts\Repositories\MetricsRepositoryInterface;

class MysqlMetricsRepository implements MetricsRepositoryInterface
{
    public function getTicketCountsByType()
    {
        $metrics = DB::select("select count(*) as total, p.type, p.color from tickets t join types p on t.type = p.id group by p.type, p.color");
        return $metrics;
    }

    public function getTicketCountsByDepartment()
    {
        $metrics = DB::select("select count(*) as total, d.department, d.color from tickets t join departments d on t.department = d.id group by d.department, d.color");
        return $metrics;
    }
}
