<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $casts=["products_id"=>"array"];
    use HasFactory;
        protected  $fillable= ['order_num','qty','price','user_id','product_id','status','address_id'];

    public function user(){
        return $this->belongsTo(user::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
    public function one_order()
    {
        return $this->belongsTo(oneOrder::class);
    }
}
