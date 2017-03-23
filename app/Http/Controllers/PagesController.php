<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    //
    public function getHomePage()
    {
    	# code...
    	$students = User::orderBy('id')->get();
    	return view('home')->withStudents($students);
    }
}
