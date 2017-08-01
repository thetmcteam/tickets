<?php

namespace App\Repositories\Eloquent;

use Illuminate\Validation\Factory as Validator;
use App\Models\Department;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\DepartmentRepositoryInterface;

class DepartmentRepository implements DepartmentRepositoryInterface
{
    private $department, $validator;

    public function __construct(Department $department, Validator $validator)
    {
        $this->validator = $validator;
        $this->department = $department;
    }

    public function findById(int $id)
    {
        //
    }

    public function all()
    {
        $departments = $this->department->all();
        return $departments;
    }

    public function create(array $data)
    {
        $validator = $this->validate($data);

        if ($validator->fails()) {
            throw new ValidationException(json_encode($validator->errors()->all()));
        }

        $this->department->create([
            'department' => $data['department'],
            'color' => $data['color'],
            'public' => $data['public']
        ]);
    }

    public function activate(int $id)
    {
        $department = $this->department->find($id);
        $department->activate();
    }

    public function deactivate(int $id)
    {
        $department = $this->department->find($id);
        $department->deactivate();
    }

    public function makePublic(int $id)
    {
        $department = $this->department->find($id);
        $department->makePublic();
    }

    public function makePrivate(int $id)
    {
        $department = $this->department->find($id);
        $department->makePrivate();
    }

    private function validate(array $data)
    {
        return $this->validator->make($data, [
            'department' => 'required|unique:departments,department',
            'color' => 'required|unique:departments,color',
            'public' => 'required|integer|in:0,1'
        ]);
    }
}
