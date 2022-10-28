<?php

namespace App\Services;

use  App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()
    {
        $user = $this->userRepository->getAll();
        return $user;
    }

    public function store($data) : Object
    {
        $validator = Validator::make($data, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->userRepository->store($data);
        return $result;
    }

    public function getUser($id)
    {
        $result = $this->userRepository->getUser($id);
        return $result;
    }

    public function destroy($id)
    {
        $user = $this->userRepository->getUser($id);
        if($user === null) {
            return;
        }
        $this->userRepository->destroy($id);
    }


}



?>
