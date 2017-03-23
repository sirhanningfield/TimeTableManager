@extends('main')

@section('title','Index')

@section('content')
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<h3>List of available courses:</h3>
			
			<table class="table">
				<thead>
					<th>#</th>
					<th>Code</th>
					<th>Name</th>
					<th>Chr</th>
					<th>Classes</th>
					<th>Start-time</th>
					<th>End-time</th>
					<th>Days</th>
					<th>Status</th>
					<th></th>
				</thead>
				<tbody>
				@foreach($courses as $course)
					<tr>
						<th>{{$course->id}}</th>
						<td>{{$course->coursecode}}</td>
						<td>{{$course->name}}</td>
						<td>{{$course->credits}}</td>
						<td>{{$course->classes}}</td>
						<td>{{$course->start_time}}</td>
						<td>{{$course->end_time}}</td>
						<td>{{$course->days}}</td>
						<td>{{$course->status}}</td>
						<td>
							<a href="{{route('coursestaken.index',$course->id) }}" class = "btn btn-warning">Add Course</a>
						</td>
						
					</tr>
				@endforeach
				</tbody>
			</table>
			<hr>

			<h3>Courses Added:</h3>
			<table class="table">
				<thead>
					<th>#</th>
					<th>Code</th>
					<th>Name</th>
					<th>Chr</th>
					<th>Classes</th>
					<th>Start-time</th>
					<th>End-time</th>
					<th>Days</th>
					<th>Status</th>
					<th></th>
				</thead>
				<tbody>
				@foreach($courses_taken as $course)
					<tr>
						<th>{{$course->id}}</th>
						<td>{{$course->coursecode}}</td>
						<td>{{$course->name}}</td>
						<td>{{$course->credits}}</td>
						<td>{{$course->classes}}</td>
						<td>{{$course->start_time}}</td>
						<td>{{$course->end_time}}</td>
						<td>{{$course->days}}</td>
						<td>{{$course->status}}</td>
						<td>
							<form action="" method= DELETE>
								{{ csrf_field() }}
								<input type="submit" name="delete" value="Delete" class="btn btn-danger">

							</form>
						</td>
						
					</tr>
				@endforeach
				</tbody>	

			</table>
			
				Total Credits taken:<strong>{{$total_credits}}</strong><br><br>
				@if($total_credits>=15)
				<a href="{{route('timetable')}}" class="btn btn-success">Complete</a>
				@endif	
		
		</div>
	</div>
	
		
	
@endsection