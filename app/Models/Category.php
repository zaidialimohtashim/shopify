<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["name","slug","parent","description","category_image","filename"];

    public function getParentCategory() {
        return $this->belongsTo(self::class, 'parent');
    }
    
}
