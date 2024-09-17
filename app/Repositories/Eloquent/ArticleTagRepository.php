<?php
namespace App\Repositories\Eloquent;

use App\Models\ArticleTag;
use App\Repositories\Contracts\IArticleTagRepository;

class ArticleTagRepository extends GenericRepository implements IArticleTagRepository{
    public function __construct(ArticleTag $articleTag) {
        parent::__construct($articleTag);
    }
}
