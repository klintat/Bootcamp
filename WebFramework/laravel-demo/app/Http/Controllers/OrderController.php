<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\Object_;

class OrderController extends Controller
{

    public function showOrder(Request $request)
    {
        $query = $request->query();
        if (isset($query["id"])) :
            $id = $query["id"];
            $order = Order::where("id", $id)->first();

            if (!($order->user_id === Auth::id())) :
                return redirect("/");
            endif;
            $email = DB::table("users")->where("id", "=", $order->user_id)->select("email")
                ->get()->first()->email;
            $order->user_email = $email;

            $orderItems = OrderItem::where("order_id", $id)->get();
            $orderProducts = [];

            foreach ($orderItems as $orderItem) :
                $product = Product::where("id", $orderItem->product_id)->get()->first();
                $orderProduct = (object)[];
                $orderProduct->id = $product->id;
                $orderProduct->name = $product->name;
                $orderProduct->quantity = $orderItem->quantity;
                array_push($orderProducts, $orderProduct);
            endforeach;
            return view('order', ["order" => $order, "order_items" => $orderProducts]);
        endif;
    }

    public static function createOrder($products): int
    {
        $order = new Order();

        $order->user_id = Auth::id();
        $order->save();

        foreach ($products as $product) :
            $orderItem = new OrderItem();
            $orderItem->product_id = $product["id"];
            $orderItem->order_id = $order->id;
            $orderItem->quantity = $product["quantity"];
            $orderItem->save();
        endforeach;

        return $order->id;
    }
}