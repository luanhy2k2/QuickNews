<?php
namespace App\Services\Contracts;
interface IGenericService{
    // public function get(int $pageIndex, int $pageSize, string $keyword);
    public function find($id);
    public function create($data);
    public function update($id, $data);
    public function delete($id);
}
