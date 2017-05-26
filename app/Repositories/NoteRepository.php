<?php

namespace App\Repositories;

use Validator;
use App\Models\Note;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\NoteRepositoryInterface;

class NoteRepository implements NoteRepositoryInterface
{
    private $note, $validator;

    public function __construct(Note $note, Validator $validator)
    {
        $this->note = $note;
        $this->validator = $validator;
    }

    public function findById(int $id)
    {
        $notes = $this->note->where('comment', $id)->orderBy('id', 'asc')->get();
        return $notes;
    }
    
    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()));
        }

        $this->note->create([
            'comment' => $data['comment'],
            'user' => $data['user'],
            'note' => $data['note']
        ]);
    }

    public function delete(int $id)
    {
        $note = $this->note->find($id);
        $note->delete();
    }

    private function validate(array $data)
    {
        return $this->validator->make($data, [
            'comment' => 'required|integer|exists:comments,id',
            'user' => 'required|integer|exists:users,id',
            'note' => 'required'
        ]);
    }
}
