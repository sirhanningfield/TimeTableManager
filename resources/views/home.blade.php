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
        </div> 
      </div> <!--end of .row-->
@endsection