<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class BannerSection extends Model
{
    use HasFactory, Resizable;
    
    protected $table = "banner_section";

    public function pages()
    {
        return $this->belongsToMany(Page::class, 'pivot_bannersec_page','id_banner_section','id_page');
    }
}
