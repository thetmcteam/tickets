<?php

namespace App\Repositories\Eloquent;

use App\Models\Invite;
use App\Exceptions\ValidationException;
use Illuminate\Validation\Factory as Validator;
use App\Contracts\Repositories\InviteRepositoryInterface;

class InviteRepository implements InviteRepositoryInterface
{
    private $invite;
    private $validator;

    public function __construct(Validator $validator, Invite $invite)
    {
        $this->invite = $invite;
        $this->validator = $validator;
    }

    public function findByUuid($uuid)
    {
        $invite = $this->invite->find($uuid);
        return $invite;
    }

    public function existsForUuid($uuid)
    {
        $invite = $this->invite->find($uuid);
        return ! is_null($invite);
    }

    public function existsForEmail($email)
    {
        $invite = $this->invite->where('email', $email);
        return $invite->count() > 0;
    }

    public function create(array $data)
    {
        $validator = $this->validator->make($data, [
            'email' => 'required|email',
            'admin' => 'required|integer|in:0,1'
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $invite = $this->invite->create([
            'email' => $data['email'],
            'admin' => $data['admin'],
            'expires_at' => date('Y-m-d H:i:s', time() + (24 * 3600))
        ]);

        return $invite;
    }

    public function delete($uuid)
    {
        $invite = $this->invite->find($uuid);
        $invite->delete();
    }
}
