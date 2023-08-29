<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;
    protected $table = "news_category";

    public function news(){
        return $this->belongsToMany(News::class,'pivot_news_category','id_news_category','id_news');
    }
}
