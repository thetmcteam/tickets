<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\TicketRepositoryInterface;

class TicketController extends Controller
{
    private $ticketRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function index()
    {
        $tickets = $this->ticketRepository->getAllPaginated(1);
        return view('tickets.all')->withTickets($tickets);
    }

    public function show(int $id)
    {
        $ticket = $this->ticketRepository->findById($id);
        return view('tickets.show')->withTicket($ticket);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user'] = $request->user()->id;
        $data['status'] = 1;

        try {
            $this->ticketRepository->create($data);
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 401);
        }

        return response(['message' => 'ticket successfully created.']);
    }

    public function delete(int $id)
    {
        $this->ticketRepository->delete($id);
        return response(['message' => 'ticket successfully removed.']);
    }
}
