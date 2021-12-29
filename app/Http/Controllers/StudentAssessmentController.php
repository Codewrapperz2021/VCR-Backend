<?php

namespace App\Http\Controllers;

use App\Models\StudentAssessment;
use Illuminate\Http\Request;
use DB;


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
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'student_answer' => 'required',
    //         'q_id' => 'required',
            
    //     ]);
        

    //     $student_assessment = new StudentAssessment();
    //     $student_assessment->student_answer	= $request->student_answer	;
    //     $student_assessment->q_id = $request->q_id;
    
    //     $student_assessment->save();
    
    // }
    public function multiplestore(Request $request)
    {
       if($request->isMethod('post')){
           $answer = $request->input();
           foreach ($answer as $key => $value) {
            $student_assessment = new StudentAssessment();
            $student_assessment->student_answer	= $value['student_answer'];
            $student_assessment->q_id = $value['q_id'];
            $student_assessment->s_id = $value['s_id'];
            $student_assessment->save();
           }
       }
    }
    public function innerJoinstudent(){
        $result = DB::table('student_assessment')
            ->join('question', 'student_assessment.q_id', '=', 'question.id')
            ->join('users', 'student_assessment.s_id', '=', 'users.id')
         
            ->select('question.question','student_assessment.student_answer','question.correctanswer', 'users.name')
            ->get();
        return $result;
    }
    
    public function update(Request $request, $id)
    {
        //
        $student_assessment = StudentAssessment::findOrFail($id);
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
