<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::paginate();

        return OrderResource::collection($order);
    }

    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }

    public function export()
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filemane=orders.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        ];

        $callback = function(){
            $orders = Order::all();
            $file = fopen('php://output','w');

            //Header Row
            fputcsv($file,['ID','NAME','EMAIL','PRODUCT TITLE','PRICE','QUANTITY']);

            //Body csv
            foreach ($orders as $order){
                fputcsv($file,[$order->id,$order->name,$order->email,'','','']);

                foreach ($order->orderItems as $orderItem){
                    fputcsv($file,['','','',$orderItem->product_title,$orderItem->price,$orderItem->quantity]);
                }
            }

            fclose($file);

        };

        return \Response::stream($callback, 200, $headers);

    }

}
