<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
            $result = '';
        if(!isset(\Auth::user()->user_id)) {
            $result = redirect()->route('login');
        } else {
            $products=  $order->getOrderProductsByUserId(\Auth::user()->user_id);
            $resultTotal = $order->resultTotal($products);

            $resultQuantity = $order->resultQuantity($products);

            $result = view('order', [
                'products' => $products,
                'resultTotal' => $resultTotal,
                'resultQuantity' => $resultQuantity
                ]);
        }

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request, Order $order)
    {
        $post = $request->post();

        $post['user_id'] = \Auth::user()->user_id;
        $order->create($post);
        return redirect()->route('order.index');
    }

    public function delete(Request $request, Order $order) {

        $responseJson = $request->post();
        $result = "";
        foreach ($responseJson as $key => $value)  {
            $result = $key;
        }
        $json = json_decode($result, true);
        $order->deleteByOrderIdAndProductId($json['order_id'], $json['product_id']);
        $products =  $order->getOrderProductsByUserId(\Auth::user()->user_id);
        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
