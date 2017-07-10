<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Contracts\Repositories\TicketRepositoryInterface;

class UserController extends Controller
{
    private $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function tickets()
    {
        $tickets = $this->ticketRepository->findByAssignee(Auth::user()->id);
        return view('user.tickets')->withTickets($tickets);
    }
}
