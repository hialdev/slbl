<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Sparepart extends Model
{
    use HasFactory, Resizable;
    protected $table = "spareparts";

    public function category(){
        return $this->belongsTo(SparepartCategory::class,'id_category_sparepart');
    }
}
