<?php
namespace App\Repositories\Eloquent;

use App\Models\FileArticle;
use App\Repositories\Contracts\IArticleFileRepository;

class ArticleFileRepository extends GenericRepository implements IArticleFileRepository{
    public function __construct(FileArticle $articleFile) {
        parent::__construct($articleFile);
    }
}
