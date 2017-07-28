<?php

namespace App\Repositories\Eloquent;

use Auth;
use App\Models\Ticket;
use App\Models\Action;
use App\Exceptions\ValidationException;
use App\Exceptions\TicketNotFoundException;
use Illuminate\Validation\Factory as Validator;
use App\Contracts\Repositories\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    private $ticket;
    private $action;
    private $validator;

    public function __construct(Ticket $ticket, Action $action, Validator $validator)
    {
        $this->ticket = $ticket;
        $this->action = $action;
        $this->validator = $validator;
    }

    public function getAllPaginated()
    {
        $tickets = $this->ticket->newQuery();
        
        if (!Auth::user()->isAdmin()) {
            $departments = Auth::user()->getViewableDepartments();
            $tickets->whereIn('department', $departments);
        }

        return $tickets->paginate(20);
    }

    public function getAllPaginatedBy($query)
    {
        $tickets = $this->ticket->newQuery();
        $tickets->search($query);

        if (!Auth::user()->isAdmin()) {
            $departments = Auth::user()->getViewableDepartments();
            $tickets->whereIn('department', $departments);
        }

        return $tickets->paginate(20);
    }

    public function findById(int $id)
    {
        $ticket = $this->ticket->find($id);
        
        if (is_null($ticket)) {
            throw new TicketNotFoundException;
        }

        return $ticket;
    }

    public function findByAssignee(int $id)
    {
        $tickets = $this->ticket->where('assignee', $id)->get();
        return $tickets;
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $this->ticket->create([
            'user' => $data['user'],
            'department' => $data['department'],
            'title' => $data['title'],
            'content' => $data['content'],
            'status' => $data['status'],
            'type' => $data['type'],
            'priority' => $data['priority']
        ]);
    }

    public function updateStatus(int $id, int $status)
    {
        $this->ticket->find($id)->update([
            'status' => $status
        ]);
    }

    public function updateAssignee(int $id, int $user)
    {
        $this->ticket->find($id)->update([
            'assignee' => $user
        ]);
    }

    public function updatePriority(int $id, int $priority)
    {
        $this->ticket->find($id)->update([
            'priority' => $priority
        ]);
    }

    public function updateType(int $id, int $type)
    {
        $this->ticket->find($id)->update([
            'type' => $type
        ]);
    }

    public function updateDepartment(int $id, int $department)
    {
        $this->ticket->find($id)->update([
            'department' => $department
        ]);
    }

    public function delete(int $id)
    {
        $ticket = $this->ticket->find($id);
        $ticket->delete();
    }

    private function validate(array $data)
    {
        return $this->validator->make($data, [
            'user' => 'required|integer|exists:users,id',
            'department' => 'required|integer|exists:departments,id',
            'title' => 'required',
            'content' => 'required',
            'status' => 'required|integer|exists:statuses,id',
            'type' => 'required|integer|exists:types,id',
            'priority' => 'required|integer|exists:priorities,id'
        ]);
    }
}
