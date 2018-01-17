<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\NotFoundException;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\AttachmentRepositoryInterface;

class AttachmentController extends Controller
{
    private $attachmentRepository;

    public function __construct(AttachmentRepositoryInterface $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    public function find(int $id)
    {
        try {
            $attachments = $this->attachmentRepository->findById($id);
        } catch (NotFoundException $e) {
            abort(404);
        }

        return response($attachments);
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|file|max:10000'
        ]);

        $path = $request->file->storeAs('attachments', sprintf('%s-%s', time(), $request->file->getClientOriginalName()));

        try {
            $this->attachmentRepository->create([
                'location' => $path,
                'user' => $request->user()->id,
                'ticket' => $request->get('ticket')
            ]);
        } catch (ValidationException $e) {
            $errors = json_decode($e->getMessage(), true);
            return response($errors);
        }
    }

    public function delete(int $id)
    {
        try {
            $this->attachmentRepository->delete($id);
        } catch (NotFoundException $e) {
            abort(404);
        }
    }
}
