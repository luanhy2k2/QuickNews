<?php
namespace App\Repositories\Eloquent;

use App\Models\ArticleTag;
use App\Repositories\Contracts\IArticleTagRepository;

class ArticleTagRepository extends GenericRepository implements IArticleTagRepository{
    private $articleTag;
    public function __construct(ArticleTag $articleTag) {
        parent::__construct($articleTag);
        $this->articleTag = $articleTag;
    }
    public function getTagsByArticleId($articleId)
{
    return $this->articleTag::where('article_id', $articleId)->get();
}

public function deleteTagsByArticleIdAndTagIds($articleId, $tagIds)
{
    $this->articleTag::where('article_id', $articleId)->whereIn('tag_id', $tagIds)->delete();
}

}
