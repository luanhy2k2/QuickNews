<?php

namespace App\Http\Controllers;

use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;
    public function __construct(IUserService $userService) {
        $this->userService = $userService;
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $token = $this->userService->login($request);
        return response()->json($token);
    }
    public function register(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15|unique:users', 
            'gender' => 'required|string|in:male,female,other',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'birth' => 'required|date',
        ]);
        $result = $this->userService->create($request->all());
        return response()->json($result);
    }
}
