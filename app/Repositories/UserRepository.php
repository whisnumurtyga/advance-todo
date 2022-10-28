<?php

namespace App\Repositories;

use  App\Models\User;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll() : Object
    {
        $user = $this->user->get();
        return $user;
    }

    public function store($data) : Object
    {
        $newUser = new $this->user;
        $newUser->id = $data['id'];
        $newUser->name = $data['name'];
        $newUser->email = $data['email'];
        $newUser->password = bcrypt($data['password']);
        $newUser->save();
        return $newUser->fresh();
    }

    public function getUser($id)
    {
        $user = $this->user->find($id);
        return $user;
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if($user === null) {
            return null;
        }
        $user->delete();
    }
}



?>
