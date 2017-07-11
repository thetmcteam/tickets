<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\ActionRepositoryInterface;

class ActionController extends Controller
{
    private $actionRepository;

    public function __construct(ActionRepositoryInterface $actionRepository)
    {
        $this->actionRepository = $actionRepository;
    }

    public function find($id)
    {
        $actions = $this->actionRepository->findByTicket($id);
        return response($actions);
    }
}
