<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\CommentRepositoryInterface;

class CommentController extends Controller
{
    private $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function find(int $id)
    {
        $comments = $this->commentRepository->findById($id);
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

        return response(['message' => 'comment successfully created.']);
    }

    public function delete(int $id)
    {
        $this->commentRepository->delete($id);
        return response(['message' => 'comment successfully deleted.']);
    }
}
