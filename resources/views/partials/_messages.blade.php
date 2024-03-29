@if(Session::has('Success'))
	
	<div class="alert alert-success" role="alert">
		<strong>Success: </strong>{{Session::get('Success')}}
	</div>
@endif

@if(Session::has('Warning'))
	<div class="alert alert-danger" role="alert">
		<strong>Warning: </strong>{{Session::get('Warning')}}
	</div>
@endif

@if(count($errors)>0)
	<div class="alert alert-danger" role="alert">
			<strong>Errors: </strong>
			<ul>
				@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>

@endif