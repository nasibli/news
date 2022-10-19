<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsComment extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    public function news()
    {
        return $this->belongsTo(News::class);
    }

    public function parent()
    {
        return $this->belongsTo(NewsComment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(NewsComment::class, 'parent_id');
    }
}
