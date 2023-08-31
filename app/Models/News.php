<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class News extends Model
{
    use HasFactory, Resizable;

    protected $table = "news";

    public function section(){
        return $this->hasOne(BannerSection::class,'id','id_banner_section');
    }

    public function banners(){
        return $this->belongsToMany(Banner::class,'pivot_news_banner','id_news','id_banner');
    }

    public function categories(){
        return $this->belongsToMany(NewsCategory::class,'pivot_news_category','id_news','id_news_category');
    }
}
