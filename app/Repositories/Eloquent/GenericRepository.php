<?php
namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\IGenericRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

class GenericRepository implements IGenericRepository{
    protected $model;
    public function __construct(Model $model) {
        $this->model = $model;
    }
    public function get(int $pageIndex, int $pageSize, array $condition = [], array $order = []):LengthAwarePaginator
    {
        $query = $this->model->newQuery();
        if (!empty($condition)) {
            foreach ($condition as $field => $value) {
                $query->where($field, 'LIKE', '%' . $value . '%');
            }
        }
        if (!empty($order)) {
            foreach ($order as $field => $direction) {
                $query->orderBy($field, $direction);
            }
        }
        $results = $query->paginate($pageSize, ['*'], 'page', $pageIndex);
        return $results;
    }
    public function find($id){
        $result = $this->model->find($id);
        return $result;
    }
    public function create($data){
        return $this->model->create($data);
    }
    public function update($id, $data)
    {
        $record = $this->model->find($id);
        $record->update($data);
        return $record;
    }
    public function delete($id)
    {
        return $this->model->destroy($id);
    }
    public function getQueryable()
    {
        return $this->model->newQuery();
    }
}
