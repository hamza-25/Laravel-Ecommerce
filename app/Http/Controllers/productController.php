<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\category;
class productController extends Controller
{
    public function getproduct()
    {
        $categories = category::all();
        $products= product::paginate(15);
        return view('homepage',['products'=>$products,"categories"=>$categories]);
    }
}
