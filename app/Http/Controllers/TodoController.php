<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Services\TodoService;

class TodoController extends Controller
{
    protected $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function getAll()
    {
        try {
            $result = $this->todoService->getAll();
        } catch(Exception $e) {
            return ApiFormatter::formatter(500, 'Failed', $e->getMessage());
        }

        return ApiFormatter::formatter(200, 'Success', $result);
    }

    public function createTodo(Request $request)
    {
        $data = $request->all();
        $result = $this->todoService->createTodo($data);

        return ApiFormatter::formatter(200, 'Success', $result);
    }

    public function updateTodo(Request $request, $id)
    {
        $data = $request->all();
        $result = $this->todoService->updateTodo($data, $id);

        return ApiFormatter::formatter(200, 'Success', $result);
    }

    public function deleteTodo($id)
    {
        $result = $this->todoService->deleteTodo($id);
        return ApiFormatter::formatter(200, 'Success', $result);
    }
}
