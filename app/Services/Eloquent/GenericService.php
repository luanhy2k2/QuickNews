<?php
namespace App\Services\Eloquent;

use App\Commons\BaseCommandResponse;
use App\Commons\BaseQueryResponse;
use App\Repositories\Eloquent\GenericRepository;
use App\Services\Contracts\IGenericService;

class GenericService implements IGenericService{
    protected $repo;
    public function __construct(GenericRepository $repo) {
        $this->repo = $repo;
    }
    public function get(int $pageIndex, int $pageSize, string $keyword){
        $order = ['created_at' =>'desc'];
        $data = $this->repo->get($pageIndex, $pageSize, [],$order);
        return new BaseQueryResponse($pageIndex,$pageSize,$keyword,$data->items(), $data->total());
    }
    public function find($id){
        if($id <= 0){
            return null;
        }
        return $this->repo->find($id);
    }
    public function create($data){
        try{
            $data->created_at = \Carbon\Carbon::now();
            $data = $this->repo->create($data);
            if($data == null){
                return new BaseCommandResponse("Thêm dữ liệu thành công", $data,false);
            }
            return new BaseCommandResponse("Thêm dữ liệu thành công", $data);
        }
        catch(\Exception $ex){
            return new BaseCommandResponse("Đã xảy ra lỗi:" . $ex->getMessage(), $data, false);
        }
    }
    public function update($id, $data){
        try{
            $data->updated_at = \Carbon\Carbon::now();
            $data = $this->repo->update($id,$data);
            if($data == null){
                return new BaseCommandResponse("Cập nhật dữ liệu thành công", $data,false);
            }
            return new BaseCommandResponse("Cập nhật dữ liệu thành công", $data);
        }
        catch(\Exception $ex){
            return new BaseCommandResponse("Đã xảy ra lỗi:" . $ex->getMessage(), $data, false);
        }
    }
    public function delete($id){
        try{
            $data = $this->repo->delete($id);
            if($data == null){
                return new BaseCommandResponse("Xoá dữ liệu thành công", $data,false);
            }
            return new BaseCommandResponse("Xoá dữ liệu thành công", $data);
        }
        catch(\Exception $ex){
            return new BaseCommandResponse("Đã xảy ra lỗi:" . $ex->getMessage(), $id, false);
        }
    }
}
