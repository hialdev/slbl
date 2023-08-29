<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparepartCategory extends Model
{
    use HasFactory;
    protected $table = "sparepart_category";

    public function spareparts(){
        return $this->hasMany(Sparepart::class,'id_category_sparepart');
    }
}
