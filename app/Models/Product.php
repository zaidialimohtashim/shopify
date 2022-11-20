<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ["title","description",'featured_image','filename'];

    public function myproduct(){
      return $this->hasMany(CustomizeProduct::class,'id','product_id');
    }
}
