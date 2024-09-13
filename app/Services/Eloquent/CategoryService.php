<?php
namespace App\Services\Eloquent;

use App\Commons\BaseQueryResponse;
use App\Repositories\Contracts\ICategoryRepository;
use App\Services\Contracts\ICategoryService;

class CategoryService extends GenericService implements ICategoryService {
    protected $categoryRepository;
    public function __construct(ICategoryRepository $categoryRepository) {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }
    public function get(int $pageIndex, int $pageSize, string $keyword){
        $condition = ['name' => $keyword];
        $order = ['created_at' =>'desc'];
        $data = $this->categoryRepository->get($pageIndex, $pageSize, $condition,$order);
        return new BaseQueryResponse($pageIndex,$pageSize,$keyword,$data->items(), $data->total());
    }

}
