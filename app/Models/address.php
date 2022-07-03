<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
        protected $fillable=["full_name","phone","user_id","country","zipcode","created_at","updated_at"];
    public function user(){
        return $this->belongsTo(user::class);
    }
}
