<?php

namespace App\Repositories;

use Illuminate\Validation\Factory as Validator;
use App\Models\Ticket;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\TicketRepositoryInterface;

class TicketRepository implements TicketRepositoryInterface
{
    private $ticket, $validator;

    public function __construct(Ticket $ticket, Validator $validator)
    {
        $this->ticket = $ticket;
        $this->validator = $validator;
    }

    public function getAllPaginated()
    {
        $tickets = $this->ticket->paginate(20);
        return $tickets;
    }

    public function findById(int $id)
    {
        $ticket = $this->ticket->find($id);
        return $ticket->toArray();
    }

    public function search(array $filters)
    {
        $tickets = $this->ticket->newQuery();

        foreach ($filters as $key => $filterable) {
            if (!empty($filterable)) {
                $tickets->whereIn($key, $filterable);
            }
        }

        return $tickets->get();
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
        $ticket = $this->ticket->find($id);
        $ticket->update([
            'status' => $status
        ]);
    }

    public function updateAssignee(int $id, int $user)
    {
        $ticket = $this->ticket->find($id);
        $ticket->update([
            'assignee' => $user
        ]);
    }

    public function updatePriority(int $id, int $priority)
    {
        $ticket = $this->ticket->find($id);
        $ticket->update([
            'priority' => $priority
        ]);
    }

    public function updateType(int $id, int $type)
    {
        $ticket = $this->ticket->find($id);
        $ticket->update([
            'type' => $type
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
