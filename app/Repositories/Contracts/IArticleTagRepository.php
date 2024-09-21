<?php
namespace App\Repositories\Contracts;
interface IArticleTagRepository extends IGenericRepository{
    function getTagsByArticleId($articleId);
    function deleteTagsByArticleIdAndTagIds($articleId, $tagIds);
}
