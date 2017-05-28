<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\DepartmentRepositoryInterface;

class DepartmentController extends Controller
{
    private $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $departments = $this->departmentRepository->all();
        return response($departments);
    }

    public function create(Request $request)
    {
        try {
            $this->departmentRepository->create($request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 401);
        }

        return response(['message' => 'department successfully created.']);
    }

    public function delete(int $id)
    {
        $this->departmentRepository->delete($id);
        return response(['message' => 'department successfully deleted.']);
    }
}
