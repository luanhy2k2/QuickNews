<?php
namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\Contracts\ITagRepository;

class TagRepository extends GenericRepository implements ITagRepository{
    protected $tag;
    public function __construct(Tag $tag) {
        parent::__construct($tag);
        $this->tag = $tag;
    }
}
