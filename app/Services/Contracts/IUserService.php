<?php
namespace App\Services\Contracts;

use Illuminate\Http\Request;

interface IUserService extends IGenericService{
    public function login($data);
    public function logout(Request $request);
}
