<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\subCategory;

class category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    

    public function subCategory(){
        return $this->hasMany(subCategory::class,"category_id");
    }
    
    public function products(){
        return $this->hasMany(product::class);
    }
}
