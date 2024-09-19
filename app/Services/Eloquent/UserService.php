<?php

namespace App\Services\Eloquent;

use App\Commons\BaseCommandResponse;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IUserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService extends GenericService implements IUserService
{
    protected $userRepo;
    public function __construct(IUserRepository $userRepo)
    {
        parent::__construct($userRepo);
        $this->userRepo = $userRepo;
    }
    public function login($data)
    {
        $user = $this->userRepo->findByUserName($data['username']);
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng'], 401);
        }
        $token = $user->createToken('authToken', ['role' => $user->role])->plainTextToken;
        return response()->json([
            'token' => $token,
            'name' => $user->name,
            'role' => $user->role
        ], 200);
    }
    public function create($data)
    {
        if($data['password'] != $data['confirmPassword']){
            return new BaseCommandResponse("Mật khẩu xác nhận không khớp", $data, false);
        }
        $file = $data['avatar'];
        $folder = 'avatars';
        $filePath = "$folder/" . uniqid() . '-' . $data['username'];
        Storage::disk('s3')->put($filePath, file_get_contents($file));
        $bucketName = env('AWS_BUCKET');
        $region = env('AWS_DEFAULT_REGION');
        $url = "https://{$bucketName}.s3.{$region}.amazonaws.com/{$filePath}";
        $data['password'] = Hash::make($data['password']);
        $data['avatar'] = $url;
        $result = $this->userRepo->create($data);
        return new BaseCommandResponse("Đăng kí tài khoản thành công", $result);
    }
}
