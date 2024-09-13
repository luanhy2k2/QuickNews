<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'article_id',
        'rating',
        'created_by'
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function article():BelongsTo{
        return $this->belongsTo(Article::class, 'article_id', 'id');
    }

}
