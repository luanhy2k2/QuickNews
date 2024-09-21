<?php
namespace App\Repositories\Eloquent;

use App\Models\Article;
use App\Repositories\Contracts\IArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository extends GenericRepository implements IArticleRepository{
    protected $article;
    public function __construct(Article $article) {
        $this->article = $article;
        parent::__construct($article);
    }
    function getByCategoryId($id, $pageIndex, $pageSize)
    {
        $query = $this->article->newQuery()->where('article_id', '=', $id)->with(['fileArticles', 'ratings', 'articleTags']);
        $result = $query->paginate($pageSize, ['*'],'page'. $pageIndex);
        return $result;
    }
    function find($id)
    {
        $article = $this->article->newQuery()->where('id','=', $id)->with([
            'category:id,name',
            'createdBy:id,name',
            'updatedBy:id,name',
            'articleTags.tag:id,name'
        ]);
        return $article->first();
    }

}

