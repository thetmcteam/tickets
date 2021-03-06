<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\NoteRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;
use App\Handlers\Notifications\CommentNotificationHandler;

class NoteController extends Controller
{
    private $noteRepository;
    private $ticketRepository;
    private $commentRepository;

    public function __construct(
        NoteRepositoryInterface $noteRepository, 
        TicketRepositoryInterface $ticketRepository, 
        CommentRepositoryInterface $commentRepository
    ) {
        $this->noteRepository = $noteRepository;
        $this->ticketRepository = $ticketRepository;
        $this->commentRepository = $commentRepository;
    }

    public function find(int $id)
    {
        $notes = $this->noteRepository->findByTicketId($id);
        return response($notes);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['user'] = $request->user()->id;

        try {
            $this->noteRepository->create($data);
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 401);
        }

        $comment = $this->commentRepository->findById($data['comment']);
        $ticket = $this->ticketRepository->findById($comment->ticket);

        $recipient = \App\Models\User::find($comment->user);
        
        $notificationHandler = new CommentNotificationHandler($ticket, $recipient, $request->user());
        $notificationHandler->handleNotification();

        return response(['message' => 'note successfully created.']);
    }
}
