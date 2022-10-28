<?php

namespace App\Repositories;

use  App\Models\Todo;

class TodoRepository
{
    protected $todo;

    public function __construct(Todo $todo)
    {
        $this->todo = $todo;
    }

    public function getAll() : Object
    {
        $todoList = $this->todo->get();
        return $todoList;
    }

    public function createTodo($data)
    {
        $newTodo = new $this->todo;
        $newTodo->id = $data['id'];
        $newTodo->title = $data['title'];
        $newTodo->date = $data['date'];
        $newTodo->note = $data['note'];
        $newTodo->save();
        return $newTodo->fresh();
    }

    public function updateTodo($data, $id)
    {
        $todo = $this->todo->find($id);
        $todo->id = $data['id'];
        $todo->title = $data['title'];
        $todo->date = $data['date'];
        $todo->note = $data['note'];
        $todo->save();
        return $todo;
    }

    public function deleteTodo($id)
    {
        $todo = $this->todo->find($id);
        $todo->delete();
        return $todo;
    }


}



?>
