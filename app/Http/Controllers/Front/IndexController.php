<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        if (Cache::has('products')) {
            $products = Cache::get('products');
        } else {
            $products = Product::where('active', 1)->select('id','name', 'hit', 'top', 'gift', 'stock', 'img', 'summary', 'properties', 'link')->orderBy('sort')->limit(6)->get();
            Cache::put('main_products', $products, now()->addMinutes(1400));

        }
        return view('front.index', compact('products'));
    }

    public function detail(Request $request)
    {
        $product = Product::find($request->id);
        if($product->properties){
            $product->properties = json_decode($product->properties);
        }

        return view('front.detail', compact('product'));





    }




}
