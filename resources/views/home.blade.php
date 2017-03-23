@extends('main')

@section('title','Home')

@section('content')
	<div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="jumbotron text-center">
            <h1>Student Time Table Manager</h1>
            <p></p>
            <p class="lead">Please <a href="{{url('/register')}}">Register</a> or <a href="{{url('/login')}}">Login</a> here</p>
          </div>
          <div class="lead">
          	view Existing Tables:<br>
          </div>
          @foreach($students as $student)
				<a href="{{ route('student.timetable',$student->id) }}">TimeTable for {{$student->name}}</a><br>
          @endforeach	
          
        </div> 
      </div> <!--end of .row-->
@endsection