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

    public function getAllPaginated(int $page)
    {
        $tickets = $this->ticket->get()->toArray();
        return $tickets;
    }

    public function findById(int $id)
    {
        $ticket = $this->ticket->find($id);
        return $ticket->toArray();
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
            'type' => $data['type']
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
            'type' => 'required|integer|exists:types,id'
        ]);
    }
}
