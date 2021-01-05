<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    //
    public function index(Product $model)
    {
        $products = $model::all();
        return view('welcome', ['products' => $products]);
    }

    public function product(Request $request, Product $model)
    {
        $responseJson = $request->post();
        $result = "";
        foreach ($responseJson as $key => $value)  {
            $result = $key;
        }
        $json = json_decode($result, true);
        $product = $model::find($json['product_id'])
            ->toArray();
        return $product;
    }
}
