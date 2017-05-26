<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\NoteRepositoryInterface;

class NoteController extends Controller
{
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function find(int $id)
    {
        $notes = $this->noteRepository->findById($id);
        return response($notes);
    }
    
    public function create(Request $request)
    {
        try {
            $this->noteRepository->create($request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 401);
        }

        return response(['message' => 'note successfully created.']);
    }
}
