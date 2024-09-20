<?php
namespace App\Services\Eloquent;

use App\Repositories\Contracts\IArticleFileRepository;
use App\Services\Contracts\IArticleFileService;

class ArticleFileService extends GenericService implements IArticleFileService{
    private $repo;
    public function __construct(IArticleFileRepository $repo) {
        parent::__construct($repo);
        $this->repo = $repo;
    }
}
