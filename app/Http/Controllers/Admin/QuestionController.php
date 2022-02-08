<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Step;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $question = Question::find($id);
        return view('admin.question.update', compact('question'));

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
        $question = Question::find($id);
        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $question->update($data);

        $step = Step::with('questions')->find($question->step_id);
        return view('admin.step.update', compact('step'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $step_id = $question->step_id;
        $question->delete();
        $step = Step::with('questions')->find($step_id);
        return view('admin.step.update', compact('step'));
    }


    public function add(Request $request)
    {
        $data = $request->all();
        if($data['questions']){
            foreach ($data['questions'] as $key => $question){
                if($question['name'] !== null){
                    \App\Models\Question::create([
                        'step_id' => $request->step_id,
                        'name' => $question['name'],
                        'sort' => is_int((int)$question['sort']) ? (int)$question['sort'] : 50
                    ]);
                }
            }
        }

        $step = Step::with('questions')->find($request->step_id);
        return view('admin.step.update', compact('step'));
    }
}
