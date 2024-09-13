<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticleTag extends Model
{
    use HasFactory;
    protected $table = 'article_tag';
    protected $fillable = [
        'article_id',
        'tag_id'
    ];
    public function article():BelongsTo{
        return $this->belongsTo(Article::class,'article_id', 'id');
    }
    public function tag():BelongsTo{
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}
