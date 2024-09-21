<?php
namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface IUserService extends IGenericService{
    public function login($data);
    public function logout(Request $request);
    public function getUserByRole($role,$pageIndex, $pageSize, $keyword);
    public function assignRoleToStaff($userId, $role);
    public function revokeRole($userId);
}
