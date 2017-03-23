<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Allcourse;
use App\TakenCourse;
use Session;

class TimetableController extends Controller
{
    //
    public function getSingleTable($id)
    {
    	$total_credits = 0;
    	# code...
    	$courses = TakenCourse::where('user_id','=',$id)->get();
    	
    	foreach ($courses as $course) {
            # code...
            $total_credits = $total_credits + $course->credits;
        }

    	return view('timetable.single')->withCourses($courses)->withTotal_credits($total_credits);

    }
}
