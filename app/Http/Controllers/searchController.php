<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\subCategory;
use Illuminate\Support\Facades\DB;



class searchController extends Controller
{
    public function search(Request $request)
    {
        if ($request->categorySearch == "all") {
            $categorySearch = $request->searchBar;
            $categories = category::all();
            $products = product::query()
                ->where('name', 'LIKE', "%{$categorySearch}%")
                ->paginate(15);
            return view("homepage", ["products" => $products, "categories" => $categories, "message" => "No Product found"]);
        }
        elseif (subCategory::where("id",$request->categorySearch)->where('category_id',$request->categoryId)) {
            $categorySearch = $request->searchBar;
            $products = DB::table("product_subcategory")
                ->join("products", "product_subcategory.product_id", "=", "products.id")
                ->where("products.name", "LIKE", "%{$categorySearch}%")
                ->where('subcategory_id', $request->categorySearch)->paginate(15);
            $categories = category::all();
            return view("homepage", ["products" => $products, "categories" => $categories, "message" => "No Product found"]);
        }
        
        elseif ($query = product::where("category_id", $request->categorySearch)->exists()) {
            $categorySearch = $request->searchBar;
            $products = product::where('category_id', $request->categorySearch)
                ->where('name', 'LIKE', "%{$categorySearch}%")->paginate(15);
            $categories = category::all();
            return view('homepage', ['products' => $products, "categories" => $categories, "message" => "No Product found"]);
        }
        else{
            return redirect()->back();
        }
    }
    public function filter(Request $request)
    {
        if ($request->lowPrice && $request->highPrice && $request->size) {
            $categories = category::all();
            $products = DB::table("products")->where("price", ">", $request->lowPrice)->where("price", "<", $request->highPrice)->where("size", '=', $request->size)->paginate(15);
            return view('homepage', ["categories" => $categories, "products" => $products, "message" => "No Product found"]);
        } elseif ($request->lowPrice && $request->highPrice) {
            $categories = category::all();
            $products = DB::table("products")->where("price", ">", $request->lowPrice)->where("price", "<", $request->highPrice)->paginate(15);
            return view('homepage', ["categories" => $categories, "products" => $products, "message" => "No Product found"]);
        } elseif ($request->size) {
            $categories = category::all();
            $size = Db::table("products")->where("size", '=', $request->size)->paginate(15);
            return view('homepage', ["categories" => $categories, "products" => $size, "message" => "No Product found"]);
        }
         else {
            return redirect()->back();
        }
    }
}
