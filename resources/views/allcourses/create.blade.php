@extends('main')

@section('title','Create Course')

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h1 class="text-center">Add Course</h1><br><br>
		<form action="{{url('/allcourses')}}" method="POST">
			{{ csrf_field() }}

			<label class="">Course Code</label>
			<input type="text" name="coursecode" class="form-control"><br>

			<label class="">Course Name</label>
			<input type="text" name="name" class="form-control"><br>
			
			<div class="form-inline form-group">
				<label class="">Course Credits </label>
				<input type="text" name="credits" class="form-control">

				<label class="" style="margin-left: 15px;">No of Classes </label>
				<input type="text" name="classes" class="form-control">
			</div><br>
			
			<div class="form-inline form-group">

				<label class="" >Start Time</label>
				<input type="text" name="start_time" class="form-control">

				<label class="" style="margin-left: 5px;">End Time</label>
				<input type="text" name="end_time" class="form-control">

				<label class="" style="margin-left: 15px;">Days </label>
				<select name="days" class="form-control">
					<option>MWF</option>
					<option>TTh</option>				
				</select> 
			</div>

			<!-- Status input signifies if the coursde is compulsory(C) or non-compulsory(NC) -->
			<label>Status: </label>
			<select name="status" class="form-control">
				<option>C</option>
				<option>NC</option>				
			</select> <br><br>

			<input type="submit" name="" value="Add Course" class="btn btn-success">
		</form>
	</div>
</div>
	
@endsection