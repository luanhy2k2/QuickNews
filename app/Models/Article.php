<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = [
        'category_id',
        'content',
        'title',
        'view',
        'approval',
        'summary',
        'created_by',
        'avatar',
        'updated_by'
    ];
    public function fileArticles(){
        return $this->hasMany(FileArticle::class);
    }
    public function articleTags(){
        return $this->hasMany(ArticleTag::class);
    }
    public function category():BelongsTo{
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function createdBy():BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function updatedBy():BelongsTo{
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'article_id');
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
