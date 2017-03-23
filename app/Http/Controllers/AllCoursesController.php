<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allcourse;
use App\TakenCourse;
use Session;

class AllCoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_credits = 0;
        //Extract all courses from database
        $courses = Allcourse::orderBy('id')->get();

        //Get taken courses:
        $course_taken = TakenCourse::orderBy('id')->get();

        foreach ($course_taken as $course) {
            # code...
            $total_credits = $total_credits + $course->credits;
        }


        //Send courses data to index view:
        return view('allcourses.index')->withCourses($courses)->withCourses_taken($course_taken)->withTotal_credits($total_credits);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('allcourses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the create form fields
         $this->validate($request,array(
                'coursecode'=> 'required|unique:allcourses,coursecode',
                'name'=>'required',
                'credits'=> 'required|integer',
                'classes'=> 'required|integer',
                'start_time'=>'required|integer',
                'end_time'=>'required|integer',
                'days'=>'required',
                'status'=>'required'
            ));

        // Inserting course data to database:
        $course = new Allcourse;
        $course->coursecode = $request->coursecode;
        $course->name = $request->name;
        $course->credits = $request->credits;
        $course->classes  = $request->classes;
        $course->start_time = $request->start_time;
        $course->end_time = $request->end_time;
        $course->days = $request->days;
        $course->status = $request->status;

        $course->save();

        Session::flash('Success','The Course was successfully added');

        //redirect to another page
        return redirect()->route('allcourses.index');


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
        //
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
        //
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
