<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Allcourse;
use App\TakenCourse;
use Session;



class CourseTakenController extends Controller
{
    //
     

    public function index($id)
    {
    	
    	
    	//Get the course the student wants to register from the all courses database
    	$attemted_course = Allcourse::find($id);

    	// Check database for any courses
    	// Check if database table is empty or not i.e there are no previous courses added:
    	$courses_taken = TakenCourse::where('user_id','=', Auth::id())->get(); 

    	

    	// if no previously added courses then simply add the course:
    	if ($courses_taken->count()==0) {
    		
	    	$course_taken = new TakenCourse;
	        $course_taken->coursecode = $attemted_course->coursecode;
	        $course_taken->name = $attemted_course->name;
	        $course_taken->credits = $attemted_course->credits;
	        $course_taken->classes  = $attemted_course->classes;
	        $course_taken->start_time = $attemted_course->start_time;
	        $course_taken->end_time = $attemted_course->end_time;
	        $course_taken->days = $attemted_course->days;
	        $course_taken->status = $attemted_course->status;
	        $course_taken->user_id = Auth::id();

	        $course_taken->save();



	        //Flash a success message
	        Session::flash('Success','Course successfully added !');


	       
	        return redirect()->route('allcourses.index');

    	}else{

    		//If there are courses already taken by the studnet then check if there are other courses that have the same days as the course he/she is trying to take:

    		$courses_with_same_day = TakenCourse::where('days','=',$attemted_course->days)->where('user_id','=', Auth::id())->get();

    		//Check if there are any courses have the same days as the attempted course:

    		//if not, then simply add the course as it will not clash
    		if ($courses_with_same_day->count()==0) {
    			# code...
    			$course_taken = new TakenCourse;
		        $course_taken->coursecode = $attemted_course->coursecode;
		        $course_taken->name = $attemted_course->name;
		        $course_taken->credits = $attemted_course->credits;
		        $course_taken->classes  = $attemted_course->classes;
		        $course_taken->start_time = $attemted_course->start_time;
		        $course_taken->end_time = $attemted_course->end_time;
		        $course_taken->days = $attemted_course->days;
		        $course_taken->status = $attemted_course->status;
		        $course_taken->user_id = Auth::id();

		        $course_taken->save();

		        //Increase the total Credits taken
		        $total_credits1 = Session::get('total_credits');
		      	$total_credits2 = $course_taken->credits;
		        
		       

		        

		        //Flash a success message
		        Session::flash('Success','Course successfully added !');

		        
		        return redirect()->route('allcourses.index');

    		}else{

    			//for courses on same day check for clash in timings 

    			$start_time1 = $attemted_course->start_time; 
    			$end_time1 = $attemted_course->end_time;

    			foreach ($courses_with_same_day as $course) {
    				
    				$start_time2 = $course->start_time;
    				$end_time2 = $course->end_time;

    				//Check clashes:
    				if ($end_time1>$start_time2 && $start_time1<$end_time2) {
						# code...
						Session::flash('Warning','This course is either already taken or Clashes with a course already taken');
						return redirect()->back();
						break;	
					}
    			}

    			// If no clashes add the attempted course to database:
    			$course_taken = new TakenCourse;
		        $course_taken->coursecode = $attemted_course->coursecode;
		        $course_taken->name = $attemted_course->name;
		        $course_taken->credits = $attemted_course->credits;
		        $course_taken->classes  = $attemted_course->classes;
		        $course_taken->start_time = $attemted_course->start_time;
		        $course_taken->end_time = $attemted_course->end_time;
		        $course_taken->days = $attemted_course->days;
		        $course_taken->status = $attemted_course->status;
		        $course_taken->user_id = Auth::id();

		        $course_taken->save();

		        //Flaash a success message
		        Session::flash('Success','Course has been successfully added');

		        //retreive all courses from database and send to the view:
		        return redirect()->route('allcourses.index');
    			
    		}

    	}

    }

    public function getTimetable()
    {
    	// Check first if the courses taken have the compulsory courses in them:


    	$courses_taken = TakenCourse::where('user_id','=', Auth::id())->where('status','=','C')->get(); //load all courses
    	
    	//if both courses are not present:
    	if($courses_taken->count()<2){
    		Session::flash('Warning','U have not taken both of your compulsory courses');
    		return redirect()->back();
    	}else{

    		$total_credits = 0;
    		$courses_taken = TakenCourse::where('user_id','=', Auth::id())->get();

    		foreach ($courses_taken as $course) {
            # code...
            $total_credits = $total_credits + $course->credits;
        	
        	}

    		return view('timetable.timetable')->withCourses_taken($courses_taken)->withTotal_credits($total_credits);
    	}

    }

    public function delete($id)
    {
    	# code...
    	//Find the course to be deleted:
    	$course_to_delete = TakenCourse::find($id);

    	// delete the course:
    	$course_to_delete->delete();

    	//Give a success message:
    	Session::flash('Success','Course ""'.$course_to_delete->name.'"" was deleted succesfully');

    	 return redirect()->route('allcourses.index');
    			
    }




}
