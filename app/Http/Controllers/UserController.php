<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Services\UserService;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll()
    {
        try {
            $result = $this->userService->getAll();
        } catch(Exception $e) {
            return ApiFormatter::formatter(500, 'Failed', $e->getMessage());
        }

        return ApiFormatter::formatter(200, 'Success', $result);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            $result = $this->userService->store($data);
        } catch(Exception $e) {
            return ApiFormatter::formatter(500, 'Failed', $e->getMessage());
        }

        return ApiFormatter::formatter(200, 'Success', $result);
    }

    public function getUser($id)
    {
        try {
            $user = $this->userService->getUser($id);
        } catch(Exception $e) {
            return ApiFormatter::formatter(500, 'Failed', $e->getMessage());
        }
        return ApiFormatter::formatter(200, 'Success', $user);
    }


    public function destroy($id)
    {

        $result = $this->userService->getUser($id);
        if($result === null) {
            return ApiFormatter::formatter(500, 'User not Exist');
        }
        $result = $this->userService->destroy($id);
        return ApiFormatter::formatter(200, 'Success delete User', $result);

    }



}
