<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileArticle extends Model
{
    use HasFactory;
    protected $table = 'file_articles';
    protected $fillable = [
        'article_id',
        'url'
    ];
    public function article():BelongsTo{
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }
}
