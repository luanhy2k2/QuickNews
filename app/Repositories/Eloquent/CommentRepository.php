<?php
namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Contracts\ICommentRepository;

class CommentRepository extends GenericRepository implements ICommentRepository{
    public function __construct(Comment $model) {
        parent::__construct($model);
    }
}
