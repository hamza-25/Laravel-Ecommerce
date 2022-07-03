<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class product extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=["name","description","price","size","image","return_policy","qty",'category_id','deleted_at'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subCategory()
    {
        return $this->belongsToMany(subCategory::class);
    }
    public function order(){
        return $this->hasMany(order::class,"product_id");
    }
}
