<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Benefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $benefits = Benefit::orderBy('sort', 'asc')->paginate(20);
        return view('admin.benefit.index', compact( 'benefits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.benefit.create');
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
        $data['img'] = Benefit::uploadImage($request);
        Benefit::create($data);
        return redirect()->route('benefits.index')->with('success', 'Преимущество добавлено');
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
        $benefit = Benefit::find($id);
        return view('admin.benefit.update', compact('benefit'));
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
        $benefit = Benefit::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        if ($file = Benefit::uploadImage($request, $benefit->img)) {
            $data['img'] = $file;
        }
        $benefit->update($data);
        return redirect()->route('benefits.index')->with('success', 'Данные приемущества успешно изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $benefit = Benefit::find($id);
        if ($benefit->img && Storage::disk('public')->exists($benefit->img)){
            Storage::disk('public')->delete($benefit->img);
        }
        $benefit->delete();
        return redirect()->route('benefits.index')->with('success', 'Преимущество удалено');
    }
    public function remove_img(Request $request)
    {
        $benefit = Benefit::find($request->id);
        Storage::delete($benefit->img);
        $benefit->img = null;
        $benefit->update();
        return $request->id;
    }


}
