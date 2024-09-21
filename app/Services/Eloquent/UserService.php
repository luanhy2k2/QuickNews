<?php

namespace App\Services\Eloquent;

use App\Commons\BaseCommandResponse;
use App\Commons\BaseQueryResponse;
use App\Enums\Role;
use App\Repositories\Contracts\IUserRepository;
use App\Services\Contracts\IUserService;
use Illuminate\Http\Request;
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
    public function get(int $pageIndex, int $pageSize, string $keyword)
    {
        $condition = ['role' => $keyword];
        $order = ['created_at' => 'desc'];
        $data = $this->userRepo->get($pageIndex, $pageSize, $condition, $order);
        return new BaseQueryResponse($pageIndex, $pageSize, $keyword, $data->items(), $data->total());
    }
    public function getUserByRole($role, $pageIndex, $pageSize, $keyword)
    {
        $query = $this->userRepo->getQueryable()->where('role', '=', $role);
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
        $result = $query->paginate($pageSize, ['*'], 'page', $pageIndex);
        return new BaseQueryResponse($pageIndex,$pageSize,$keyword,$result->items(), $result->total());
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
            'id' => $user->id,
            'role' => $user->role
        ], 200);
    }
    public function logout(Request $request)
    {
        $this->userRepo->deleteCurrentToken($request);

        return ['message' => 'Đăng xuất thành công'];
    }
    public function create($data)
    {
        if ($data['password'] != $data['confirmPassword']) {
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
    public function assignRoleToStaff($userId, $role)
    {
        $user = $this->userRepo->find($userId);
        if ($user == null) {
            return new BaseCommandResponse("Tài khoản không tồn tại!", $userId, false);
        }
        $user->role = $role;
        if ($this->update($userId, ['role' => $role])) {
            return new BaseCommandResponse("Cập nhật vai trò thành công!", $user);
        }

        return new BaseCommandResponse("Cập nhật vai trò không thành công!", $userId, false);
    }
    public function revokeRole($userId)
    {
        $user = $this->userRepo->find($userId);
        if ($user == null) {
            return new BaseCommandResponse("Tài khoản không tồn tại!", $userId, false);
        }
        if ($this->update($userId, ['role' => Role::Client->value])) {
            return new BaseCommandResponse("Thu hồi quyền hạn thành công!", $user);
        }
        return new BaseCommandResponse("Thu hồi quyền hạn không thành công!", $userId, false);
    }
}
