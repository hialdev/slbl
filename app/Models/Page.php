<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Page extends Model
{
    use HasFactory, Resizable;
    protected $table = "pages";

    public function sections()
    {
        return $this->belongsToMany(BannerSection::class, 'pivot_bannersec_page','id_banner_section','id_page');
    }
    
    public function banner()
    {
        return $this->hasOne(Banner::class, 'id_page');
    }
}
