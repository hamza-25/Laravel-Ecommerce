<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\oneOrder;
use App\Models\order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class cartController extends Controller
{
    private string $cookie_key = "PRODUCT_COOKIE";
    ##
    public function add_product_to_cart_home($id)
    {
        return redirect()->route("itemHome")->cookie($this->cookie_key, $this->build_cart_str($id));
    }
    ###

    public function add_product_to_cart($id)
    {
        return redirect()->route("productview", ["productId" => $id, "added-to-cart" => true])->cookie($this->cookie_key, $this->build_cart_str($id));
    }
    ##
    public function remove_product_from_cart_home($id)
    {
        return redirect()->route("itemHome")->cookie($this->cookie_key, $this->remove_from_cart($id));
    }
    ###
    public function cartDelete($id)
    {
        return redirect()->route("see-product-cart")->cookie($this->cookie_key, $this->remove_from_cart($id));
    }
    ###
    public function remove_product_from_cart($id)
    {
        return redirect()->route("productview", ["productId" => $id, 'remove_from_cart' => true])->cookie($this->cookie_key, $this->remove_from_cart($id));
    }
    ##

    private function remove_from_cart($idRemove)
    {
        $cookie_str = Cookie::get($this->cookie_key);
        $cookie_str_arr = explode(',', $cookie_str);
        $cookie_str_arr = array_filter($cookie_str_arr, function ($id) use ($idRemove) {
            return $id != $idRemove;
        });
        return implode(",", $cookie_str_arr);
    }
    ##
    public function see_product_cart()
    {
        $address=address::where("user_id",Auth::user()->id)->get();
        $cookie_str = Cookie::get($this->cookie_key);
        $cookie_str_arr = explode(',', $cookie_str);
        return view('productCart', ["product" => product::Wherein('id', $cookie_str_arr)->get(),"address"=>$address]);
    }
    ##
    private function build_cart_str($id): string
    {
        $cookie_str = Cookie::get($this->cookie_key);
        $cookie_str_arr = explode(',', $cookie_str);
        if (!in_array($id, $cookie_str_arr) && count($cookie_str_arr) > 0 && $cookie_str) {
            $cookie_str_arr[] = $id;
            return implode(',', $cookie_str_arr);
        }
        return $id;
    }
    ####
    public function shopFromCart(Request $request, $id)
    {
        $product = product::find($id);
        $quantity = $request->quantity;
        $total = $product->price * $quantity;
        return view("shopFromCart", ["product" => $product, "quantity" => $quantity, "total" => $total]);
    }
    public function allincart(Request $request)
    {
        $validation = $request->validate([
            "quantity"=> "required",
            "price"=> "required",
            "id"=> "required",
            "put"=> "required",
            "CashOnDelivery"=> "required"
        ]);
        $total_price=0;
        $oneOrderSerial= Auth::user()->id . Str::random(10) ;

        // $oneOrder= new oneOrder();
        // $oneOrder->id= $oneOrderSerial;
        // $oneOrder->serial= $oneOrderSerial;
        // $oneOrder->total_price= $total_price;
        // $oneOrder->user_id= Auth::user()->id;
        // $oneOrder->save();

        foreach ($request->name as $key => $name) {
            $pro_id= $request->id;
            $order = new order();
            $product = product::find($pro_id);
            $order->order_num = Str::random(20);
            $order->qty = $request->quantity[$key];
            $qty=$request->quantity[$key];
            $order->price =  $request->price[$key] * $qty ;
            $order->user_id = Auth::user()->id;
            $order->product_id = $request->id[$key];
            $order->address_id = $request->put;
            $order->one_order=  $oneOrderSerial;
            $total_price += $request->price[$key] * $qty;
            $order->save();
        }
        $oneOrder= new oneOrder();
       // $oneOrder->id= $oneOrderSerial;
        $oneOrder->serial= $oneOrderSerial;
        $oneOrder->total_price= $total_price;
        $oneOrder->user_id= Auth::user()->id;
        $oneOrder->save();
        return redirect()->route("clientOrder")->with(["message2"=>"order placed"]);

    }
    public function addNewAddress(Request $request)
    {
        $validation =$request->validate([
            'full_name' => 'required',
            'country' => 'required',
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'phone' => 'required|numeric',
        ]);
        $address= new address();
        $address->full_name= $request->full_name;
        $address->country= $request->country;
        $address->province= $request->province;
        $address->city= $request->city;
        $address->phone= $request->phone;
        $address->address= $request->address;
        $address->zipcode= $request->zipcode;
        $address->user_id= Auth::user()->id;
        $address->save();
        return redirect()->back()->with(["message"=>"Address added Successfully"]);

    }
}
