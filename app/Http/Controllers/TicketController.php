<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Exceptions\TicketNotFoundException;
use App\Exceptions\UpdateNotAllowedException;
use App\Contracts\Repositories\ActionRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;

use App\Models\{
    Status,
    Type,
    Priority,
    Department
};

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
        if (
            $request->has('query') 
            || $request->has('status') 
            || $request->has('priority') 
            || $request->has('department') 
            || $request->has('type')
        ) {
            $tickets = $this->ticketRepository->getAllPaginatedBy($request->all());
        } else {
            $tickets = $this->ticketRepository->getAllPaginated();
        }

        return view('tickets.all')
            ->withTickets($tickets)
            ->withDepartments(Department::all())
            ->withStatuses(Status::all())
            ->withPriorities(Priority::all())
            ->withTypes(Type::all())
            ->withQuery($request->all());
    }

    public function show(int $id)
    {
        try {
            $ticket = $this->ticketRepository->findById($id);
        } catch (TicketNotFoundException $e) {
            abort(404);
        }

        return view('tickets.show')->withTicket($ticket->toArray());
    }

    public function search(Request $request)
    {
        $tickets = $this->ticketRepository->search($request->get('filters'));
        return response($tickets);
    }

    public function updateStatus(Request $request, $id)
    {
        $statusId = intval($request->get('status'));
        
        try {
            $this->ticketRepository->updateStatus($id, $statusId);
        } catch (TicketNotFoundException $e) {
            abort(404);
        } catch (UpdateNotAllowedException $e) {
            abort(400);
        }

        $status = \App\Models\Status::find($statusId);
        $this->actionRepository->log(Auth::user()->id, $id, 'status', [
            'value' => $status->status,
            'color' => $status->color
        ]);

        return response(['message' => 'ticket updated.']);
    }

    public function updatePriority(Request $request, $id)
    {
        $priorityId = intval($request->get('priority'));

        try {
            $this->ticketRepository->updatePriority($id, $priorityId);
        } catch (TicketNotFoundException $e) {
            abort(404);
        } catch (UpdateNotAllowedException $e) {
            abort(400);
        }

        $priority = \App\Models\Priority::find($priorityId);
        $this->actionRepository->log(Auth::user()->id, $id, 'priority', [
            'value' => $priority->priority,
            'color' => $priority->color
        ]);

        return response(['message' => 'ticket updated.']);
    }

    public function updateAssignee(Request $request, $id)
    {
        $assigneeId = intval($request->get('assignee'));
        
        try {
            $this->ticketRepository->updateAssignee($id, $assigneeId);
        } catch (TicketNotFoundException $e) {
            abort(404);
        } catch (UpdateNotAllowedException $e) {
            abort(400);
        }

        $assignee = \App\Models\User::find($assigneeId);
        $this->actionRepository->log(Auth::user()->id, $id, 'assign', [
            'value' => $assignee->name,
            'color' => '#8e44ad'
        ]);

        $assignee->notify((new \App\Notifications\Assigned(
            $this->ticketRepository->findById($id),
            Auth::user(),
            $assignee
        ))->delay(Carbon::now()->addMinutes(1)));

        return response(['message' => 'ticket updated.']);
    }

    public function updateType(Request $request, $id)
    {
        $typeId = intval($request->get('type'));
        
        try {
            $this->ticketRepository->updateType($id, $typeId);
        } catch (TicketNotFoundException $e) {
            abort(404);
        } catch (UpdateNotAllowedException $e) {
            abort(400);
        }

        $type = \App\Models\Type::find($typeId);
        $this->actionRepository->log(Auth::user()->id, $id, 'type', [
            'value' => $type->type,
            'color' => $type->color
        ]);

        return response(['message' => 'ticket updated.']);
    }

    public function updateDepartment(Request $request, $id)
    {
        $departmentId = intval($request->get('department'));
        
        try {
            $this->ticketRepository->updateDepartment($id, $departmentId);
        } catch (TicketNotFoundException $e) {
            abort(404);
        } catch (UpdateNotAllowedException $e) {
            abort(400);
        }

        $department = \App\Models\Department::find($departmentId);
        $this->actionRepository->log(Auth::user()->id, $id, 'department', [
            'value' => $department->department,
            'color' => $department->color
        ]);

        return response(['message' => 'ticket updated.']);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user'] = $request->user()->id;
        $data['status'] = 1;

        try {
            $this->ticketRepository->create($data);
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 422);
        }

        return response(['message' => 'ticket created.'], 200);
    }

    public function delete(int $id)
    {
        try {
            $this->ticketRepository->delete($id);
        } catch (TicketNotFoundException $e) {
            abort(404);
        }

        return response(['message' => 'ticket removed.'], 200);
    }
}
