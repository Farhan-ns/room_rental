@extends('layouts.app')

@section('title') {{ $title }} @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h3>{{ $title }}</h3>
			<p>by {{ $user_fname . " " . $user_lname }}</p>
			<p>Email: {{ $user_email }}</p>
			<p>Mobile: {{ $user_mobile }}</p>
			<p>{{ $type }}</p>
			<p>{{ $location }}</p>
			<p>{{ $price }}</p>
			<p>{{ $description }}</p>
			
			<div class="row">
				@for($i = 0; $i <= 5; $i++)
				<div class="col-md-6 post-img">
					<img src="/uploads/posts/default.jpg" class="img-posts" alt="{{ $title }}" />
				</div>
				@endfor
			</div>

		</div>
		<div class="col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<b>Send Message to Owner</b>
				</div>
				<div class="panel-body">
					<form action="#" method="POST" role="form">
						<div class="form-group">
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" required="" />
						</div>
						<div class="form-group">
							<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required="" />
						</div>
						<div class="form-group">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" required="" />
						</div>
						<div class="form-group">
						<textarea class="form-control" rows="10" name="message" id="message" placeholder="You message here..." required=""></textarea>
						</div>
						<div class="form-group text-right">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button type="sumbit" class="btn btn-primary">Send</button>
							<button type="reset" class="btn btn-danger">Clear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection