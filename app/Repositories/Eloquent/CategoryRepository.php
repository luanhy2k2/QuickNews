<?php
namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Contracts\ICategoryRepository;

class CategoryRepository extends GenericRepository implements ICategoryRepository{
    public function __construct(Category $model) {
        parent::__construct($model);
    }
}
