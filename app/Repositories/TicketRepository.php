<?php

namespace App\Repositories;

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

    public function findById(int $id)
    {
        $ticket = $this->ticket->find($id);
        return $ticket;
    }
    
    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()));
        }

        $this->ticket->create([
            'user' => $data['user'],
            'department' => $data['department'],
            'title' => $data['title'],
            'content' => $data['content']
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
        ]);
    }
}