<?php

namespace App\Repositories\Eloquent;

use Auth;
use App\Models\Ticket;
use App\Models\Action;
use App\Exceptions\ValidationException;
use App\Exceptions\TicketNotFoundException;
use App\Exceptions\UpdateNotAllowedException;
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

    public function getAllPaginatedBy(array $data)
    {
        $tickets = $this->ticket->newQuery();
        
        if (isset($data['query'])) {
            $tickets->search($data['query']);
        }

        if (isset($data['department'])) {
            if (!Auth::user()->isAdmin()) {
                $departments = Auth::user()->getViewableDepartments();
                $tickets->whereIn('department', $departments);
                $tickets->where('department', $data['department']);
            } else {
                $tickets->where('department', $data['department']);
            }
        }

        if (isset($data['status'])) {
            $tickets->where('status', $data['status']);
        }

        if (isset($data['type'])) {
            $tickets->where('type', $data['type']);
        }

        if (isset($data['priority'])) {
            $tickets->where('priority', $data['priority']);
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
        $ticket = $this->findById($id);

        if ($ticket->getStatusId() === $status) {
            throw new UpdateNotAllowedException;
        }

        $ticket->update([
            'status' => $status
        ]);
    }

    public function updateAssignee(int $id, int $user)
    {
        $ticket = $this->findById($id);

        if ($ticket->getAssigneeId() === $user) {
            throw new UpdateNotAllowedException;
        }

        $ticket->update([
            'assignee' => $user
        ]);
    }

    public function updatePriority(int $id, int $priority)
    {
        $ticket = $this->findById($id);

        if ($ticket->getPriorityId() === $priority) {
            throw new UpdateNotAllowedException;
        }

        $ticket->update([
            'priority' => $priority
        ]);
    }

    public function updateType(int $id, int $type)
    {
        $ticket = $this->findById($id);

        if ($ticket->getTypeId() === $type) {
            throw new UpdateNotAllowedException;
        }

        $ticket->update([
            'type' => $type
        ]);
    }

    public function updateDepartment(int $id, int $department)
    {
        $ticket = $this->findById($id);

        if ($ticket->getDepartmentId() === $department) {
            throw new UpdateNotAllowedException;
        }

        $ticket->update([
            'department' => $department
        ]);
    }

    public function delete(int $id)
    {
        $ticket = $this->findById($id);
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
