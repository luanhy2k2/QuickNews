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
        'appApproval',
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
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
