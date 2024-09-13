<?php
namespace App\Repositories\Contracts;

use App\Commons\BasePaging;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface IGenericRepository{
    public function get(int $pageIndex, int $pageSize, array $condition = [], array $order = []):LengthAwarePaginator;
    public function find($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
    public function getQueryable();
}
