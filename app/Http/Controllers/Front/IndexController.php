<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

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
                $stages['steps'][$i] = [
                    'id'=> $step->id,
                    'name'=> $step->name,
                    'received' => false,
                    'answer' => [],
                    'step' => $i
                ];
                $i++;
            }
            $stages['count'] = $steps->count();
            $stages['step'] = 1;
            session(['quiz' => $stages]);

        } else {
            $stages = session('quiz');
        }

        $total = $stages['count'] +1;


        if($request->option == 'start'){
            $item = Arr::first($stages['steps'], function ($value) {
                return $value['received'] == false;
            }, $stages['count']);
            $step = Step::with('questions')->find($item['id']);
            $number =$item['step'];



            $benefits = $step->benefits();
            $prev = $number > 1 ? $number -1 : false;
            $next = $number < $stages['count'] ? $number+1 : false;


            return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));





        }


        if($request->option == 'next'){

            $step = Step::with('questions')->find(2);
            $number = 2;

            dd($request->all());
        }








        //$benefits = $step->benefits();
        //$prev = $number > 1 ? $number -1 : false;
        //$next = $number < $stages['count'] ? $number+1 : false;


        //return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));




    }


















    public function clean(Request $request)
    {

        $request->session()->forget('quiz');


    }



}
