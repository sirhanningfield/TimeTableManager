<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    	//Check if database table is empty or not i.e there are no previous courses added:
    	$courses_taken = TakenCourse::orderBy('id')->get(); 

    	

    	// if no previously added courses then simply add the course:
    	if ($courses_taken->count()==0) {
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

	        $course_taken->save();



	        //set the credits taken in a session
	        Session::flush();
	        Session::put('total_credits', $course_taken->credits);
	        
	        $total_credits = Session::get('total_credits');
	        //dd($total_credits);

	        //Flash a success message
	        Session::flash('Success','Course successfully added !');


	       
	        return redirect()->route('allcourses.index');

    	}else{

    		//If there are courses already taken by the studnet then check if there are other courses that have the same days as the course he/she is trying to take:

    		$courses_with_same_day = TakenCourse::where('days','=',$attemted_course->days)->get();

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

		        $course_taken->save();

		        //Increase the total Credits taken
		        $total_credits1 = Session::get('total_credits');
		      	$total_credits2 = $course_taken->credits;
		        
		        //dd($total_credits2);

		        Session::put('total_credits', $total_credits2);

		       

		        

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


    	$C_courses_taken = TakenCourse::where('status','=','C')->get(); //load all courses
    	
    	//if both courses are not present:
    	if($C_courses_taken->count()<2){
    		Session::flash('Warning','U have not taken both of your compulsory courses');
    		return redirect()->back();
    	}else{

    		$courses_taken = TakenCourse::orderBy('id')->get();

    		return view('timetable.timetable')->withCourses_taken($courses_taken);
    	}

    }

    public function delete($id)
    {
    	# code...
    }




}
