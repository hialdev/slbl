<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;

class ProductCategory extends Model
{
    use HasFactory, Resizable;
    protected $table = "product_category";

    public function products(){
        return $this->hasMany(Product::class,'id_product_category');
    }
}
