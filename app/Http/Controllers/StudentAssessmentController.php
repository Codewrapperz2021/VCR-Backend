<?php

namespace App\Http\Controllers;

use App\Models\StudentAssessment;
use Illuminate\Http\Request;


class StudentAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StudentAssessment::all();
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
        $request->validate([
            'student_answer' => 'required',
            'q_id' => 'required',
            
        ]);

        $student_assessment = new StudentAssessment();
        $student_assessment->student_answer	= $request->student_answer	;
        $student_assessment->q_id = $request->q_id;
    
        $student_assessment->save();
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentAssessment  $studentAssessment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student_assessment = StudentAssessment::findOrFail($id);
        return $student_assessment;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentAssessment  $studentAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAssessment $studentAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentAssessment  $studentAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentAssessment  $studentAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAssessment $studentAssessment)
    {
        //
    }
}
