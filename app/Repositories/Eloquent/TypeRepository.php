<?php

namespace App\Repositories\Eloquent;

use Illuminate\Validation\Factory as Validator;
use App\Models\Type;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\TypeRepositoryInterface;

class TypeRepository implements TypeRepositoryInterface
{
    private $type, $validator;

    public function __construct(Type $type, Validator $validator)
    {
        $this->type = $type;
        $this->validator = $validator;
    }

    public function all()
    {
        $types = $this->type->all();
        return $types;
    }

    public function findById(int $id)
    {
        //
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $this->type->create([
            'type' => strtolower($data['type'])
        ]);
    }

    public function delete(int $id)
    {
        $type = $this->type->find($id);
        $type->delete();
    }

    private function validate(array $data)
    {
        return $this->validator->make($data, [
            'type' => 'required|unique:types,type'
        ]);
    }
}
