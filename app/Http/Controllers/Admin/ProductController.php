<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Property;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('sort', 'asc')->paginate(20);
        return view('admin.product.index', compact( 'products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $properties = Property::all()->sortBy('sort');
        return view('admin.product.create', compact( 'properties', ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['hit'] = $request->has('hit') ? 1 : 0;
        $data['top'] = $request->has('top') ? 1 : 0;
        $data['stock'] = $request->has('stock') ? 1 : 0;
        $data['gift'] = $request->has('gift') ? 1 : 0;

        $properties = [];
        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }
        }
        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);
        $data['img'] = Product::uploadImage($request);

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Товар добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $properties = json_decode($product->properties, true);
        return view('admin.product.update', compact('product',  'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, $id)
    {
        $product = Product::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['hit'] = $request->has('hit') ? 1 : 0;
        $data['top'] = $request->has('top') ? 1 : 0;
        $data['stock'] = $request->has('stock') ? 1 : 0;
        $data['gift'] = $request->has('gift') ? 1 : 0;

        $properties = [];
        if($data['properties']){
            foreach ($data['properties'] as $key => $property){
                if($property['value'] !== null){
                    $properties[$key] = $property;
                }
            }
        }
        $data['properties'] = json_encode($properties,JSON_UNESCAPED_UNICODE);

        if ($file = Product::uploadImage($request, $product->img)) {
            $data['img'] = $file;
        }
        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Данные товара успешно изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->img && Storage::disk('public')->exists($product->img)){
            Storage::disk('public')->delete($product->img);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар удален');
    }

    public function remove_img(Request $request)
    {
        $product = Product::find($request->id);
        Storage::delete($product->img);
        $product->img = null;
        $product->update();
        return $request->id;
    }
}
