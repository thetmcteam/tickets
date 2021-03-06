<?php

namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use Illuminate\Validation\Factory as Validator;
use App\Models\Comment;
use App\Exceptions\ValidationException;
use App\Exceptions\CommentNotFoundException;
use App\Contracts\Repositories\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    private $comment, $validator;

    public function __construct(Comment $comment, Validator $validator)
    {
        $this->comment = $comment;
        $this->validator = $validator;
    }

    public function findById(int $id)
    {
        $comments = $this->comment->find($id);
        return $comments;
    }

    public function findByTicketId(int $id)
    {
        $comments = $this->comment->where('ticket', $id)->orderBy('id', 'asc')->get();
        return $comments;
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $this->comment->create([
            'ticket' => $data['ticket'],
            'user' => $data['user'],
            'content' => $data['content']
        ]);
    }

    public function delete(int $id)
    {
        $comment = $this->comment->find($id);
        
        if (is_null($comment)) {
            throw new CommentNotFoundException;
        }

        $comment->delete();
    }

    private function validate(array $data)
    {
        return $this->validator->make($data, [
            'ticket' => 'required|integer|exists:tickets,id',
            'user' => 'required|integer|exists:users,id',
            'content' => 'required'
        ]);
    }
}
