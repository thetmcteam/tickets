<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Exceptions\TicketNotFoundException;
use App\Contracts\Repositories\ActionRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;

class TicketController extends Controller
{
    private $ticketRepository;
    private $actionRepository;

    public function __construct(TicketRepositoryInterface $ticketRepository, ActionRepositoryInterface $actionRepository)
    {
        $this->ticketRepository = $ticketRepository;
        $this->actionRepository = $actionRepository;
    }

    public function index(Request $request)
    {
        if (($query = $request->get('query')) !== null) {
            $tickets = $this->ticketRepository->getAllPaginatedBy($query);
        } else {
            $tickets = $this->ticketRepository->getAllPaginated();
        }

        return view('tickets.all')->withTickets($tickets);
    }

    public function show(int $id)
    {
        try {
            $ticket = $this->ticketRepository->findById($id);
        } catch (TicketNotFoundException $e) {
            abort(404);
        }

        return view('tickets.show')->withTicket($ticket);
    }

    public function search(Request $request)
    {
        $tickets = $this->ticketRepository->search($request->get('filters'));
        return response($tickets);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function updateStatus(Request $request, $id)
    {
        $statusId = intval($request->get('status'));
        $this->ticketRepository->updateStatus($id, $statusId);
        $status = \App\Models\Status::find($statusId);

        $this->actionRepository->log(Auth::user()->id, $id, 'status', [
            'value' => $status->status,
            'color' => $status->color
        ]);

        return response(['message' => 'ticket successfully updated.']);
    }

    public function updatePriority(Request $request, $id)
    {
        $priorityId = intval($request->get('priority'));
        $this->ticketRepository->updatePriority($id, $priorityId);
        $priority = \App\Models\Priority::find($priorityId);

        $this->actionRepository->log(Auth::user()->id, $id, 'priority', [
            'value' => $priority->priority,
            'color' => $priority->color
        ]);

        return response(['message' => 'ticket successfully updated.']);
    }

    public function updateAssignee(Request $request, $id)
    {
        $assigneeId = intval($request->get('assignee'));
        $this->ticketRepository->updateAssignee($id, $assigneeId);
        $assignee = \App\Models\User::find($assigneeId);

        $this->actionRepository->log(Auth::user()->id, $id, 'assigee', [
            'value' => $assignee->name,
            'color' => '#8e44ad'
        ]);

        return response(['message' => 'ticket successfully updated.']);
    }

    public function updateType(Request $request, $id)
    {
        $typeId = intval($request->get('type'));
        $this->ticketRepository->updateType($id, $typeId);
        $type = \App\Models\Type::find($typeId);

        $this->actionRepository->log(Auth::user()->id, $id, 'type', [
            'value' => $type->type,
            'color' => $type->color
        ]);

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
