<?php
namespace App\Repositories\Contracts;

use App\Repositories\Contracts\IGenericRepository;
use Illuminate\Http\Request;

interface IUserRepository extends IGenericRepository{
    public function findByUserName($userName);
    public function deleteCurrentToken(Request $request);
}
