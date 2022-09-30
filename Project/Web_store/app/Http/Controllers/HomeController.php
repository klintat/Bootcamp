<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{

    public function index()
    {
        $product=Product::all();// if state all -> then all products will be shown
        return view('home.userpage', compact('product'));
    }


    public function redirect()
    {
        $usertype=Auth::user()->usertype;

        if($usertype=='1')
        {
            $total_product=product::all()->count();
            $total_order=order::all()->count();
            $total_user=user::all()->count();
            
            $order=order::all();
            $total_revenue=0;

            foreach($order as $order)
            {
                $total_revenue=$total_revenue + $order->price;
            }

            return view('admin.home', compact('total_product','total_order','total_user', 'total_revenue'));
        }
        else
        {   
            $product=Product::all();
            return view('home.userpage',compact('product'));
        }
    }


    public function product_details($id)
    {
        $product=product::find($id);
        return view('home.product_details', compact('product'));
    }

    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user=Auth::user();
            $userid=$user->id;
            $product=product::find($id);
            $product_exist_id=cart::where('Product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();
            
            if($product_exist_id)
            {
                $cart=cart::find($product_exist_id)->first();
                $quantity=$cart->quantity;
                $cart->quantity=$quantity + $request->quantity;
                $cart->price=$product->price * $cart->quantity;
                $cart->save();

                return redirect()->back()->with('message','Product Added Successfully');
            }

            else
            {
            $cart=new cart;
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->user_id=$user->id;

            $cart->product_title=$product->title;
            $cart->price=$product->price;
            $cart->image=$product->image;
            $cart->product_id=$product->id;

            $cart->quantity=$request->quantity;

            $cart->price=$product->price * $request->quantity;

            $cart->save();
            return redirect()->back()->with('message','Product Added Successfully');
            }
            
        }

        else
        {
            return redirect('login');
        }
    }

    public function show_cart()
    {
        if(Auth::id())
        { 
            $id=Auth::user()->id;
            $cart=cart::where('user_id','=',$id)->get();
            return view('home.showcart', compact('cart'));
        }
        else
        {
            return redirect('login');
        }
    }

    public function remove_cart($id)
    {
        $cart=cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

    public function cash_order(Request $request) // quantity 
    {
        $user=Auth::user();
        $user_id=$user->id;
        $data=cart::where('user_id','=', $user_id)->get();

        foreach($data as $data)
        {
            $order=new order;
            $order->name=$data->name;
            $order->email=$data->email;
            $order->phone=$data->phone;
            $order->address=$data->address;

            $order->user_id=$data->user_id;
            $order->product_title=$data->product_title;
            $order->price=$data->price;
            $order->quantity=$data->quantity;
            $order->image=$data->image;
            $order->product_id=$data->product_id;

            $order->save();

            $product = Product::where('id', $data->product_id)->first();
            $product->quantity = $product->quantity - $data->quantity;
            $product->update();

            $cart_id=$data->id;
            $cart=cart::find($cart_id);
            $cart->delete();
        }

        return redirect()->back()->with('message', 'Order Recived! We will contact you shortly...');
    }

    
    public function show_order() 
    {
        if(Auth::id()) 
        {
            $user=Auth::user();
            $userid=$user->id;

            $order=order::where('user_id','=', $userid)->get();
            return view('home.order', compact('order'));
        } 
    
        else 
        {
            return redirect('login');
        }
    }

    public function product()
    {
        $product=Product::all();
        return view('home.all_product', compact('product'));
    }

}
