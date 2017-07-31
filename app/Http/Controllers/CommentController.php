<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Exceptions\CommentNotFoundException;
use App\Contracts\Repositories\NoteRepositoryInterface;
use App\Contracts\Repositories\TicketRepositoryInterface;
use App\Contracts\Repositories\CommentRepositoryInterface;

class CommentController extends Controller
{
    private $noteRepository;
    private $ticketRepository;
    private $commentRepository;

    public function __construct(
        NoteRepositoryInterface $noteRepository, 
        CommentRepositoryInterface $commentRepository, 
        TicketRepositoryInterface $ticketRepository
    ) {
        $this->noteRepository = $noteRepository;
        $this->ticketRepository = $ticketRepository;
        $this->commentRepository = $commentRepository;
    }

    public function find(int $id)
    {
        $comments = $this->commentRepository->findByTicketId($id);
        return response($comments);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        $data['user'] = $request->user()->id;

        try {
            $this->commentRepository->create($data);
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 401);
        }

        $ticket = $this->ticketRepository->findById($data['ticket']);
        ($user = $ticket->user()->first())->notify((new \App\Notifications\Reply(
            $user,
            $ticket,
            Auth::user(),
            $data['content']
        ))->delay(Carbon::now()->addMinutes(1)));

        return response(['message' => 'comment created.'], 200);
    }

    public function delete(int $id)
    {
        try {
            $this->commentRepository->delete($id);
        } catch (CommentNotFoundException $e) {
            abort(404);
        }

        $this->noteRepository->deleteByComment($id);
        return response(['message' => 'comment deleted.'], 200);
    }
}
