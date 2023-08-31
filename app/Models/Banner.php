<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Banner extends Model
{
    use HasFactory, Resizable;

    protected $table = "banners";

    public function news(){
        return $this->belongsToMany(News::class,'pivot_news_banner','id_banner','id_news');
    }
}
