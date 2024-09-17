<?php
namespace App\Services\Eloquent;

use App\Repositories\Contracts\IArticleTagRepository;
use App\Services\Contracts\IArticleTagService;

class ArticleTagService extends GenericService implements IArticleTagService{
    private $repo;
    public function __construct(IArticleTagRepository $repo) {
        parent::__construct($repo);
        $this->repo = $repo;
    }
}
