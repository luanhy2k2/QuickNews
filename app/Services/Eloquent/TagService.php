<?php
namespace App\Services\Eloquent;

use App\Commons\BaseQueryResponse;
use App\Repositories\Contracts\ITagRepository;
use App\Services\Contracts\ITagService;

class TagService extends GenericService implements ITagService{
    protected $tagRepo;
    public function __construct(ITagRepository $tagRepo) {
        parent::__construct($tagRepo);
        $this->tagRepo = $tagRepo;
    }
    public function get(int $pageIndex, int $pageSize, string $keyword)
    {
        $condition = ['name' => $keyword];
        $result = $this->tagRepo->get($pageIndex,$pageSize,$condition,[]);
        return new BaseQueryResponse($pageIndex,$pageSize,$keyword,$result->items(),$result->total());
    }
    public function getAll()
    {
        $result = $this->tagRepo->getQueryable()->select('id', 'name')->get();
        return $result;
    }
}
