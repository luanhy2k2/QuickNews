<?php
namespace App\Repositories\Contracts;
interface IArticleRepository extends IGenericRepository{
    function getByCategoryId($id, $pageIndex, $pageSize);
}
