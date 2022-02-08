<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Step;
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

    public function quiz(Request $request)
    {
        if (!$request->session()->has('quiz')) {
            $steps = Step::where('active', 1)->orderBy('sort')->get();
            $stages = [];
            $i = 1;
            foreach($steps as $step){
                $stages[$i] = [
                    'id'=> $step->id,
                    'name'=> $step->name,
                    'received' => false,
                    'answer' => []
                ];
                $i++;
            }
            $stages['count'] = $steps->count();
            $stages['step'] = 1;
            session(['quiz' => $stages]);
        } else {
            $stages = session('quiz');
        }

        $step = Step::with('questions')->find($stages[$stages['step']]['id']);

        $total = $stages['count'] +1;
        $number = $stages['step'];
        $benefits = $step->benefits();




        return view('front.quiz', compact('step', 'total', 'number', 'benefits'));













    }
}
