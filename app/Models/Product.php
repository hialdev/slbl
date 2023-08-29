<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";

    public function category(){
        return $this->belongsTo(ProductCategory::class,'id_product_category');
    }

}
