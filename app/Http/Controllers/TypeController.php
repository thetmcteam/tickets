<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Contracts\Repositories\TypeRepositoryInterface;

class TypeController extends Controller
{
    private $typeRepository;

    public function __construct(TypeRepositoryInterface $typeRepository)
    {
        $this->typeRepository = $typeRepository;
    }

    public function index()
    {
        $types = $this->typeRepository->all();
        return response($types);
    }

    public function store(Request $request)
    {
        try {
            $this->typeRepository->create($request->all());
        } catch (ValidationException $e) {
            return response(json_decode($e->getMessage()), 401);
        }

        return response(['message' => 'ticket type successfully created.']);
    }

    public function create()
    {
    }

    public function delete(int $id)
    {
        $this->typeRepository->delete($id);
        return response(['message' => 'ticket type successfully deleted.']);
    }
}
