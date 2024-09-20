<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\IUserRepository;
use App\Repositories\Eloquent\GenericRepository;
use Illuminate\Http\Request;

class UserRepository extends GenericRepository implements IUserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }
    public function deleteCurrentToken(Request $request)
    {
        return $request->user()->currentAccessToken()->delete();
    }
    public function findByUserName($userName)
    {
        $result = $this->user->where('username', $userName)->first();
        return $result;
    }
}

