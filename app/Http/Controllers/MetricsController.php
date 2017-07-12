<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\MetricsRepositoryInterface;

class MetricsController extends Controller
{
    private $metricsRepository;

    public function __construct(MetricsRepositoryInterface $metricsRepository)
    {
        $this->metricsRepository = $metricsRepository;
    }

    public function getTicketCountByType()
    {
        $metrics = $this->metricsRepository->getTicketCountsByType();
        return response($metrics);
    }

    public function getTicketCountsByDepartment()
    {
        $metrics = $this->metricsRepository->getTicketCountsByDepartment();
        return response($metrics);
    }
}
