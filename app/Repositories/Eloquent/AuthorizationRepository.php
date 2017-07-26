<?php

namespace App\Repositories\Eloquent;

use App\Models\Authorization;
use App\Contracts\Repositories\AuthorizationRepositoryInterface;
use Illuminate\Validation\Factory as Validator;

class AuthorizationRepository implements AuthorizationRepositoryInterface
{
    private $validator;
    private $authorization;

    public function __construct(Authorization $authorization, Validator $validator)
    {
        $this->validator = $validator;
        $this->authorization = $authorization;
    }

    public function findById(int $id)
    {
        $authorizations =  $this->authorization->where('user', $id)->get();
        return $authorizations;
    }

    public function create(array $data)
    {
        $validator = $this->validator->make($data, [
            'user' => 'required|integer|exists:users,id',
            'department' => 'required|integer|exists:departments,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $this->authorization->create([
            'user' => $data['user'],
            'department' => $data['department']
        ]);
    }
    
    public function delete(int $id)
    {
        $authorization = $this->authorization->find($id);
        $authorization->delete();
    }
}
