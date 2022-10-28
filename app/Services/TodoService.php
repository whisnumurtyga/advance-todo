<?php

namespace App\Services;

use  App\Models\Todo;
use App\Repositories\TodoRepository;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TodoService
{
    protected $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    public function getAll()
    {
        $todoList = $this->todoRepository->getAll();
        return $todoList;
    }

    public function createTodo($data)
    {
        $todo = [
			'id'=>$data['id'],
			'title'=>$data['title'],
			'date'=>$data['date'],
			'note'=>$data['note']
		];

        $result = $this->todoRepository->createTodo($todo);
        return $result;
    }

    public function updateTodo($data, $id)
    {
        $todo = [
            'id' => $id,
			'title'=>$data['title'],
			'date'=>$data['date'],
			'note'=>$data['note']
		];

        $result = $this->todoRepository->updateTodo($todo, $id);
        return $result;
    }

    public function deleteTodo($id)
    {
        $result = $this->todoRepository->deleteTodo($id);
        return $result;
    }


}



?>
