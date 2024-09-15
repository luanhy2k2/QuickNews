<?php
namespace App\Services\Eloquent;

use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IUserService;
use Illuminate\Support\Facades\Hash;

class UserService extends GenericService implements IUserService{
    protected $userRepo;
    public function __construct(IUserRepository $userRepo) {
        parent::__construct($userRepo);
        $this->userRepo = $userRepo;
    }
    public function login($data)
    {
        $user = $this->userRepo->findByUserName($data['username']);
        if(!$user || !Hash::check($data['password'], $user->password)){
            return "Tài khoản hoặc mật khẩu không đúng";
        }
        $token = $user->createToken('authToken')->plainTextToken;
        return $token;
    }
    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);
        $result = parent::create($data);
        return $result;
    }
}
