@extends('main')

@section('title','Single table')

@section('content')
	<h3>List of courses:</h3>
			
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
												
					</tr>
				@endforeach
				</tbody>
			</table>
			Total Credits taken:<strong>{{$total_credits}}</strong><br><br>
					
@endsection