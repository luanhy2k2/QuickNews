<?php
namespace App\Services\Contracts;
interface IArticleService extends IGenericService{
    function getByCategoryId($id, $pageIndex, $pageSize);
    function uploadFile($request);
    function deleteFile($fileUrl);
    function mostPopular(int $pageIndex,int $pageSize);
    function trending($pageIndex, $pageSize);
    function mostInteraction($pageIndex, $pageSize);
    function updateStatus($articleId, $approval);
}

