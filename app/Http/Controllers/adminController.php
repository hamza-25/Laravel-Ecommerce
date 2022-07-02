<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\order;
use App\Models\subCategory;
use App\Models\User;
use App\Models\address;
use App\Models\product;
use App\Models\oneOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{

    public function categorypage()
    {
        $categories = category::all();
        //->where("parent_id", null);

        return view('admin.categorypage', ["categories" => $categories]);
    }
    #####
    public function addcategory(Request $request)
    {
        $user =  category::where('name', $request->categoryname)->exists();
        if ($user == null) {
            $validation = $request->validate([
                'categoryname' => 'required',
                // 'parent_id' => 'nullable|numeric'
            ]);
            $addcategory = new category();
            $addcategory->name = $request->categoryname;
            $addcategory->save();
            return redirect()->back()->with(["message1" => "Category added Successfully"]);
        } else {
            return redirect()->back()->with(["message2" => "Category name already exist"]);
        }
    }
    #####
    public function deletecategory($id)
    {
        $product = category::find($id);
        $product->delete();
        return redirect()->back()->with("message8", "category deleted");
    }
    #####
    public function subcategorypage()
    {
        $categories = category::orderby('name', 'asc')->get();
        return view('admin.subcategorypage', compact('categories'));
    }
    #####
    public function addsubcategory(Request $request)
    {
        $subcategory = subCategory::where("name", $request->subcategoryname)->where("category_id", $request->radioinput)->first();

        if ($subcategory == null) {
            $validation = $request->validate([
                'subcategoryname' => 'required',
                'radioinput' => 'required'
            ]);
            $addsubcategory = new subcategory();
            $addsubcategory->name = $request->subcategoryname;
            $addsubcategory->category_id = $request->radioinput;
            $addsubcategory->save();
            return redirect()->back()->with("message", "sub-Category added Successfully");
        } else {
            return redirect()->back()->with("message10", "sub-Category already exists");
        }
    }
    #####
    public function editsubpage($id)
    {
        $subcategory = subCategory::find($id);
        return view('admin.editsubpage', ["subcategory" => $subcategory]);
    }
    #####
    public function editsub(Request $request, $id)
    {
        $subcategory = subCategory::find($id);
        $sub = subCategory::where("name", $request->name)->where("category_id", $subcategory->category_id)->first();
        if ($sub == null) {
            $subcategory->name = $request->name;
            $subcategory->save();
            return redirect()->back()->with("message11", "sub-Category updated");
        } else {
            return redirect()->back()->with("message12", "sub-Category already exists");
        }
    }
    #####
    public function deletesub($id)
    {
        $subcategory = subCategory::find($id);
        $subcategory->delete();
        return redirect()->back()->with("message13", "sub-Category updated");
    }
    #####
    public function editpage($id)
    {

        $category = category::find($id);
        return view("admin.editpage", ["category" => $category]);
    }
    #####
    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'categoryname' => 'required'
        ]);
        $user =  category::where('name', $request->categoryname)->exists();
        if ($user == null) {
            $validation = $request->validate([
                'categoryname' => 'required'
            ]);
            $updatecategory = category::find($id);;
            $updatecategory->name = $request->categoryname;
            $updatecategory->save();
            return redirect()->back()->with(["message3" => "Category name updated Successfully"]);
        } else {
            return redirect()->back()->with(["message4" => "Category name already exist"]);
        }
    }
    #####
    public function productpage()
    {
        $categories = category::all();
        $products = product::paginate(15);
        //$subCategory= subCategory::all();
        return view('admin.productpage', ["products" => $products, "categories" => $categories,]);
    }
    #####
    public function addproduct(Request $request)
    {
        if (subCategory::where("id", $request->subcategory)->where("category_id", $request->category)->first()) {
            $validation = $request->validate([
                "name" => "Required",
                "description" => "Required",
                "price" => "Required|numeric",
                "size" => "Required",
                "qty" => "Required",
                "returnpolicy" => "Required",
                "photo" => "Required|URL",
                "category" => "Required",
                "subcategory" => "Required"
            ]);
            $addproduct = new product();
            $addproduct->name = $request->name;
            $addproduct->description = $request->description;
            $addproduct->price = $request->price;
            $addproduct->size = $request->size;
            $addproduct->qty = $request->qty;
            $addproduct->image = $request->photo;
            $addproduct->return_policy = $request->returnpolicy;
            $addproduct->category_id = $request->category;
            $addproduct->save();
            $prduct_sub = DB::table('product_subcategory')->insert([
                'product_id' => $addproduct->id,
                'subcategory_id' => $request->subcategory,
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            return redirect()->back()->with("message5", "product added Successfully");
        } else {
            return redirect()->back()->with("message15", "category and subcategory not compatible between them");
        }
    }
    #####
    public function editproduct($id)
    {
        //  $numId = $id;| , "numId" => $numId | , "categories" => $categories
        // $categories = category::find($id);
        $product = product::find($id);
        return view("admin.updateproduct", ["product" => $product]);
    }
    #####
    public function updateproduct(Request $request, $id)
    {
        $validation = $request->validate([
            "name" => "Required",
            "description" => "Required",
            "price" => "Required|numeric",
            "qty" => "Required",
            "returnpolicy" => "Required",
            "photo" => "Required|URL",
            // "category" => "Required"
        ]);
        $product = product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->qty = $request->qty;
        $product->return_policy = $request->returnpolicy;
        $product->image = $request->photo;
        $product->update();

        return redirect()->back()->with("message6", "product updated Successfully");
    }
    #####
    public function deleteproduct($id)
    {
        $order = order::where("product_id", $id)->exists();
        if ($order) {
            $product = product::find($id);
            $product->delete();
            return redirect()->back()->with("message7", "product deleted");
        } else {
            $product = product::find($id)->forceDelete();
            return redirect()->back()->with("message7", "product deleted");
        }
    }
    #####
    public function customerorderpage()
    {
       
        $orders = User::join('orders', 'users.id', '=', 'orders.user_id')->where('one_order',null)
            ->paginate(15, ['users.*', 'orders.order_num', 'orders.status', 'orders.product_id', 'orders.address_id', 'orders.id', 'orders.created_at', 'orders.qty', 'orders.price']);
        return view("admin.customerorderpage", ["orders" => $orders]);
    }
    #####
    public function orderdetail($id, $pid, $aid)
    {
        $order = order::find($id);
        $address = address::where("id", $aid)->get();
        $product = product::where('id', $pid)->get();
        return view("admin.orderdetails", ["address" => $address, "product" => $product, "order" => $order]);
    }
    ####
    public function changestatus($id,$status)
    {
       
        $order = order::find($id);
        $order->status = $status;
        $order->update();
        return redirect()->back()->with(["message16" => 'status changed successfully']);
    }
    ####
    public function changestatusOneOrder($id,$status)
    {
       
        $order = oneOrder::find($id);
        $order->status = $status;
        $order->update();
        return redirect()->back()->with(["message16" => 'status changed successfully']);
        
    }
    ####
    public function producttrashed()
    {
        //   $products= product::where("deleted_at")->get();
        $products = DB::table('products')
            ->whereNotNull('deleted_at')
            ->paginate(15);
        return view('admin.producttrashed', ["products" => $products]);
    }
    public function orderHasProduct()
    {
        $orders = oneOrder::join('users', 'one_orders.user_id', '=', 'users.id')
            ->paginate(15, ['one_orders.*', 'users.name','users.last_name']);
        return view("admin.customerorderHasProduct", ["orders" => $orders]);
    }
    public function showOrderHasProduct($id)
    {
        $orders = order::where('one_order',$id)
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->paginate(15, ['orders.*', 'orders.order_num', 'orders.status', 'orders.product_id','users.name', 'orders.address_id', 'orders.id', 'orders.created_at', 'orders.qty', 'orders.price']);
        $count = count($orders);
        return view("admin.showOrderHasProduct",["orders"=>$orders,"count"=>$count]);
    }
}
