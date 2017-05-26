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

    public function find(int $id)
    {
        $ticket = $this->ticketRepository->findById($id);
        return response($ticket);
    }

    public function create(Request $request)
    {
        try {
            $this->ticketRepository->create($request->all());
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
