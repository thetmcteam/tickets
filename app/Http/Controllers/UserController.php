<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;
    private $ticketRepository;

    public function __construct(UserRepositoryInterface $userRepository, TicketRepositoryInterface $ticketRepository)
    {
        $this->userRepository = $userRepository;
        $this->ticketRepository = $ticketRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();
        return response($users);
    }

    public function deactivate($id)
    {
        $this->userRepository->delete($id);
        return response(['message' => 'user deactivated.']);
    }

    public function tickets()
    {
        $tickets = $this->ticketRepository->findByAssignee(Auth::user()->id);
        return view('user.tickets')->withTickets($tickets);
    }
}
