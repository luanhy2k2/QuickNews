<?php
namespace App\Services\Contracts;
interface IArticleService extends IGenericService{
    function getByCategoryId($id, $pageIndex, $pageSize);
    function uploadFile($request);
    function deleteFile($fileUrl);
}

