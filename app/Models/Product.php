<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','size','image','image_path','tags', 'price', 'desc','stock','brand_id','category_id'];

    protected $primaryKey = 'id';
}
