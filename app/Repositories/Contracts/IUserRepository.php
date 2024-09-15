<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\IGenericRepository;

interface IUserRepository extends IGenericRepository{
    public function findByUserName($userName);
}
