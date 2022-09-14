<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $order, $orderProducts;
    public function __construct(int $id)
    {
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
        $this->order = $order;
        $this->orderProducts = $orderProducts;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('order', [
            "order" => $this->order,
            "order_items" => $this->orderProducts
        ]);
    }
}