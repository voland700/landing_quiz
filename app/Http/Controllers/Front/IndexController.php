<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Callback;
use App\Models\Issue;
use App\Models\Product;
use App\Models\Result;
use App\Models\Step;
use App\Models\Benefit;
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


    public function start(Request $request)
    {

        $stages = Step::getSession();
        $item = Arr::first($stages['steps'], function ($value) {
            return $value['received'] == false;
        }, $stages['steps'][array_key_last($stages['steps'])]);
        //$id = array_key_exists('id', $item) ? $item['id'] : $stages['count'];

        $step = Step::with('questions')->find($item['id']);
        $benefits = Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(4)->get();

        $total = $stages['total'];
        $number = $item['step'];

        $prev =  $item['step'] > 1 ? $stages['steps'][$item['step'] - 1]['id'] : false;
        $next =  $item['step'] < $stages['count'] ? $stages['steps'][$item['step'] + 1]['id'] : false;
        return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));
    }

    public function next(Request $request)
    {
        $stages = Step::getSession();
        $data = $request->data;
        if(array_key_exists('answer', $data)) $request->session()->put('quiz.steps.'.$data['step'].'.answer', [$data['answer']]);
        if(array_key_exists('message', $data)) $request->session()->put('quiz.steps.'.$data['step'].'.message', $data['message'] );
        if(array_key_exists('extra', $data)) $request->session()->put('quiz.steps.'.$data['step'].'.extra', $data['extra']);
        $request->session()->put('quiz.steps.'.$data['step'].'.received', true );
        $benefits = Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(4)->get();
        if(!$data['next'] == false) {
            $step = Step::with('questions')->find($data['next']);
            $total = $stages['total'];
            $number = $data['step'] + 1;
            $prev =  $stages['steps'][$data['step']]['id'];
            $next =  $number < $stages['count'] ? $stages['steps'][$number + 1]['id'] : false;
            return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));
        }else{
            return view('front.quiz_last', compact( 'benefits'));
        }
    }

    public function prev(Request $request)
    {
        $stages = Step::getSession();
        $data = $request->data;
        if(array_key_exists('answer', $data)) $request->session()->put('quiz.steps.'.$data['step'].'.answer');
        if(array_key_exists('message', $data)) $request->session()->put('quiz.steps.'.$data['step'].'.message');
        if(array_key_exists('extra', $data)) $request->session()->put('quiz.steps.'.$data['step'].'.extra');
        $request->session()->put('quiz.steps.'.$data['step'].'.received', false );

        $step = Step::with('questions')->find($data['prev']);
        $benefits = Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(4)->get();

        $total = $stages['total'];
        $number = $data['step'] - 1;
        $prev =  $number > 1 ? $stages['steps'][$number - 1]['id'] : false;
        $next =  $stages['steps'][$data['step']]['id'];
        return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));
    }

    public function result(Request $request)
    {
        $stages = Step::getSession();
        $result = [];
        foreach ($stages['steps'] as $key => $step) {
            $result[$key]['name'] = $step['name'];
            if($step['answer']){
                foreach ($step['answer'] as $k=>$item){
                    if($item == "on") unset($step['answer'][$k]);
                }
            }
            if(array_key_exists(0, $step['answer'])){
                $step['answer'] = Arr::flatten($step['answer']);
            }
            $result[$key]['answer'] = $step['answer'] ? $step['answer'] : false;
            $result[$key]['extra'] = $step['extra'] ? $step['extra'] : false;
            $result[$key]['message'] = $step['message'] ? $step['message'] : false;
        }
        $data = $request->all();
        $data['result'] = json_encode($result,JSON_UNESCAPED_UNICODE);
        Result::create($data);
        $request->session()->forget('quiz');
        return ['success'=>'ok'];
    }

    public function callback_show()
    {
        return view('front.callback');
    }

    public function callback(Request $request)
    {
        $callback = new Callback($request->all());
        $callback->save();
        return ['success'=>'ok'];
    }

    public function ask_price(Request $request)
    {
        $product = Product::select('id','name')->find($request->id);
        return view('front.issue', compact('product'));
    }
    public function ask_store(Request $request)
    {

        $issue = new Issue($request->all());
        //$issue->name = $request->name;
        //$issue->phone = $request->phone;
        //$issue->product_id = $request->id;
        $issue->save();
        return ['success'=>'ok'];


        //return $request->all();
    }






























    public function getResult()
    {
        $stages = Step::getSession();
        $result = [];
        foreach ($stages['steps'] as $key => $step) {
            $result[$key]['name'] = $step['name'];
            if($step['answer']){
                foreach ($step['answer'] as $k=>$item){
                    if($item == "on") unset($step['answer'][$k]);
                }
            }
            if(array_key_exists(0, $step['answer'])){
                $step['answer'] = Arr::flatten($step['answer']);
            }
            $result[$key]['answer'] = $step['answer'] ? $step['answer'] : false;
            $result[$key]['extra'] = $step['extra'] ? $step['extra'] : false;
            $result[$key]['message'] = $step['message'] ? $step['message'] : false;
        }

        dd($result);
    }






    public function gets(Request $request)
    {
        dd(session('quiz'));
    }


    public function clean(Request $request)
    {
        $request->session()->forget('quiz');



    }



}
