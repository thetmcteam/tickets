<?php

namespace App\Repositories\Eloquent;

use App\Models\Attachment;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\AttachmentRepositoryInterface;
use Illuminate\Validation\Factory as Validator;

class AttachmentRepository implements AttachmentRepositoryInterface
{
    private $validator;
    private $attachment;

    public function __construct(Attachment $attachment, Validator $validator)
    {
        $this->validator = $validator;
        $this->attachment = $attachment;
    }

    public function findById(int $id)
    {
        $attachments = $this->attachment->where('ticket', $id)->get();
        return $attachments;
    }

    public function create(array $data)
    {
        $this->validate($data);

        $this->attachment->create([
            'user' => $data['user'],
            'ticket' => $data['ticket'],
            'location' => $data['location'],
            'type' => @end(explode('.', $data['location']))
        ]);
    }

    public function delete(int $id)
    {
        $attachment = $this->findById($id);
        $attachment->delete();
    }

    private function validate(array $data)
    {
        $validator = $this->validator->make($data, [
            'user' => 'required|integer|exists:users,id',
            'ticket' => 'required|integer|exists:tickets,id',
            'location' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = json_encode($validator->errors()->all());
            throw new ValidationException($errors);
        }
    }
}
