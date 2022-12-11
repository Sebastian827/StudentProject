<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses=Course::with('semester')->get();

       
            return $courses;

       

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
            'name'=>'required',
            'credits'=>'required',
            'teacher_name'=>'required',
            'autonomy_hours'=>'required',
            'directed_hours'=>'required',
            'semester_id'=>'required',
        ]);
        $course = new Course();
        $course->name=$request->name;
        $course->credits=$request->credits;
        $course->teacher_name=$request->teacher_name;
        $course->prerequisit=$request->prerequisit;
        $course->autonomy_hours=$request->autonomy_hours;
        $course->directed_hours=$request->directed_hours;
        $course->semester_id=$request->semester_id;
        $course->save();

        return $course;

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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course=Course::find($id);

        $course->name=$request->name;
        $course->credits=$request->credits;
        $course->teacher_name=$request->teacher_name;
        $course->prerequisit=$request->prerequisit;
        $course->autonomy_hours=$request->autonomy_hours;
        $course->directed_hours=$request->directed_hours;
        $course->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course=Course::find($id);

        $course->delete();
    }
}
