<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $userService;
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }
    public function get(Request $request)
    {
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $result = $this->userService->get($pageIndex, $pageSize, $keyword);
        return response()->json($result);
    }
    public function getUserByRole(Request $request)
    {
        $pageIndex = $request->query('pageIndex', 1);
        $pageSize = $request->query('pageSize', 10);
        $keyword = $request->query('keyword', '');
        $role = $request->route('role');
        $result = $this->userService->getUserByRole($role,$pageIndex, $pageSize, $keyword);
        return response()->json($result);
    }
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        $token = $this->userService->login($validatedData);
        return response()->json($token);
    }
    public function logout(Request $request)
    {
        $response = $this->userService->logout($request);
        return response()->json($response, 200);
    }
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:15|unique:users',
            'gender' => 'required|string|in:male,female,other',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirmPassword' => 'required|string|min:8',
            'address' => 'required|string|max:255',
            'birth' => 'required|date',
            'avatar' => 'required|file|max:10240',
        ]);
        $validatedData['role'] = Role::Client->value;
        $result = $this->userService->create($validatedData);
        return response()->json($result);
    }
    public function assignRoleToStaff(Request $request)
    {
        $validatedData = $request->validate([
            'role' => 'required|string|in:Admin,Editor,Author,SupportStaff,Client',
        ]);
        $userId = $request->route('id');
        $result = $this->userService->assignRoleToStaff($userId, $validatedData['role']);
        return response()->json($result);
    }
    public function revokeRole(Request $request)
    {
        $userId = $request->route('id');
        $result = $this->userService->revokeRole($userId);
        return response()->json($result);
    }
    public function getById($id)
    {
        $result = $this->userService->find($id);
        return response()->json($result);
    }
}
