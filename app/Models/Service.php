<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Service extends Model
{
    use HasFactory, Resizable;
    
    protected $table = "services";
    
    public function category(){
        return $this->belongsTo(ServiceCategory::class,'id_category_service');
    }
}
