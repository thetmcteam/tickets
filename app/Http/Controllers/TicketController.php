<?php

namespace App\Http\Controllers;

use App\Models\Note;
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

    public function showByDepartment(int $id)
    {
        $tickets = $this->ticketRepository->getAllPaginatedByDepartment($id, 0);
        return view('tickets.all')->withTickets($tickets);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function updateStatus(Request $request, $id)
    {
        $status = intval($request->get('status'));
        $this->ticketRepository->updateStatus($id, $status);
        return response(['message' => 'ticket successfully updated.']);
    }

    public function updatePriority(Request $request, $id)
    {
        $priority = intval($request->get('priority'));
        $this->ticketRepository->updatePriority($id, $priority);
        return response(['message' => 'ticket successfully updated.']);
    }

    public function updateAssignee(Request $request, $id)
    {
        $assignee = intval($request->get('assignee'));
        $this->ticketRepository->updateAssignee($id, $assignee);
        return response(['message' => 'ticket successfully updated.']);
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
