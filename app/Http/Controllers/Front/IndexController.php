<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
                    'extra' => [],
                    'message' => [],
                    'step' => $i
                ];
                $i++;
            }
            $stages['count'] = $steps->count();
            session(['quiz' => $stages]);
        } else {
            $stages = session('quiz');
        }

        $total = $stages['count'] +1;
        $benefits = Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(4)->get();

        if($request->option == 'start'){
            $item = Arr::first($stages['steps'], function ($value) {
                return $value['received'] == false;
            }, $stages['count']);

                $step = Step::with('questions')->find($item['id']);
                $number =$item['step'];
                $prev = !$item['step'] == 1 ? $stages['steps'][$item['step'] - 1]['id'] : false;
                $next =  $item['step'] < $stages['count'] ? $stages['steps'][$item['step'] + 1]['id'] : false;
                return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));
        }

        if($request->option == 'next'){
            $data = $request->data;
            if(array_key_exists('answer', $data)) $request->session()->push('quiz.steps.'.$data['step'].'.answer', $data['answer'] );
            if(array_key_exists('message', $data)) $request->session()->push('quiz.steps.'.$data['step'].'.message', $data['message'] );
            $request->session()->push('quiz.steps.'.$data['step'].'.received', true );
            if(array_key_exists('extra', $data)) $request->session()->push('quiz.steps.'.$data['step'].'.extra', $data['extra']);
            if(!$request->data['next']  == false){
                $step = Step::with('questions')->find($data['next']);
                $number = $data['step'] + 1;
                $prev =  $stages['steps'][$data['step']]['id'];
                $next =  $number < $stages['count'] ? $stages['steps'][$number+1]['id'] : false;
                return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));
            }else{
                return view('front.quiz_last', compact('benefits'));
            }


        }

        if($request->option == 'prev') {
            $data = $request->data;
            $request->session()->push('quiz.steps.'.$data['step'].'.answer', []);
            $request->session()->push('quiz.steps.'.$data['step'].'.message', []);
            $request->session()->push('quiz.steps.'.$data['step'].'.received', false );
            $request->session()->push('quiz.steps.'.$data['step'].'.extra', []);
            $step = Step::with('questions')->find($data['prev']);
            $number = $data['step'] - 1;
            $prev =  $number > 1 ? $stages['steps'][$number - 1]['id'] : false;
            $next =  $stages['steps'][$data['step']]['id'];
            return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));
        }
/*
        if($request->option == 'last' && $request->data['prev']  == false) {

            $data = $request->data;
            $request->session()->push('quiz.steps.'.$data['step'].'.answer', []);
            $request->session()->push('quiz.steps.'.$data['step'].'.message', []);
            $request->session()->push('quiz.steps.'.$data['step'].'.received', false );
            $request->session()->push('quiz.steps.'.$data['step'].'.extra', []);
            return view('front.quiz-last', compact('benefits'));


            //return $request->all();
        }
*/
    }

    public function start(Request $request)
    {

        $stages = Step::getSession();
        $item = Arr::first($stages['steps'], function ($value) {
            return $value['received'] == false;
        }, $stages['count']);

        $step = Step::with('questions')->find($item['id']);
        $benefits = Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(4)->get();

        $total = $stages['total'];
        $number = $item['step'];
        $prev = !$item['step'] == 1 ? $stages['steps'][$item['step'] - 1]['id'] : false;
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

        $step = Step::with('questions')->find($data['next']);
        $benefits = Benefit::where('active', 1)->select('name', 'img')->orderBy('sort')->limit(4)->get();

        $total = $stages['total'];
        $number = $data['step'] + 1;
        $prev =  $stages['steps'][$data['step']]['id'];
        $next =  $number < $stages['count'] ? $stages['steps'][$number + 1]['id'] : false;
        return view('front.quiz', compact('step', 'total', 'number', 'benefits', 'prev', 'next'));

        //dd($request->all());
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














    public function gets(Request $request)
    {
        dd(session('quiz'));
    }


    public function clean(Request $request)
    {
        $request->session()->forget('quiz');



    }



}
