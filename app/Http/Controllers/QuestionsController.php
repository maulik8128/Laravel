<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data =  Questions::query();
            return datatables()->of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                        $btn = '';

                            return $btn;
                    })
                    ->editColumn('id', function($row){

                        return '<input type="checkbox" class="bulk_action" name="multi_check_users[]" value="'.$row->id.'">';
                    })
                    ->editColumn('ans', function($row){

                        return "$row->ans";
                    })
                    ->editColumn('question', function($row){

                        return "$row->question";
                    })
                    ->rawColumns(['action','id','ans','question'])
                    ->make(true);
        }
        return view('questions.questions');
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
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {
        //
    }
}
