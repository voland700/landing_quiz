<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductsRequest;
use App\Models\Step;
use App\Models\Question;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $steps = Step::orderBy('sort', 'asc')->paginate(40);
        return view('admin.step.index', compact( 'steps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.step.create');
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
        $data['obligatory'] = $request->has('obligatory') ? 1 : 0;
        $data['type'] = $request->has('type') ? 1 : 0;
        $data['extra'] = $request->has('extra') ? 1 : 0;
        $step = Step::create($data);
        if($data['questions']){
            foreach ($data['questions'] as $key => $question){
                if($question['name'] !== null){
                    \App\Models\Question::create([
                        'step_id' => $step->id,
                        'name' => $question['name'],
                        'sort' => is_int((int)$question['sort']) ? (int)$question['sort'] : 50
                    ]);
                }
            }
        }
        return redirect()->route('steps.index')->with('success', 'Новый квест созздан');
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
        $step = Step::with('questions')->find($id);
        return view('admin.step.update', compact('step'));
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
        $step = Step::with('questions')->find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['obligatory'] = $request->has('obligatory') ? 1 : 0;
        $data['type'] = $request->has('type') ? 1 : 0;
        $data['extra'] = $request->has('extra') ? 1 : 0;
        $step->update($data);
        if($data['questions']){
            foreach ($data['questions'] as $key => $question){
                if($question['name'] !== null){
                    \App\Models\Question::create([
                        'step_id' => $step->id,
                        'name' => $question['name'],
                        'sort' => is_int((int)$question['sort']) ? (int)$question['sort'] : 50
                    ]);
                }
            }
        }
        return redirect()->route('steps.index')->with('success', 'Данные успешно изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
