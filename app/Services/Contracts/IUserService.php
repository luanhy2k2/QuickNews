<?php
namespace App\Services\Contracts;
interface IUserService extends IGenericService{
    public function login($data);
}
