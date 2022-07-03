<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class oneOrder extends Model
{
       protected $fillable=['serial',"total_price", "status","user_id"];
    use HasFactory;
    public function order(){
        return $this->hasMany(order::class,"one_order");
    }
    public function user(){
        return $this->belongsTo(user::class);
    }
}

