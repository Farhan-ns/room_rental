@extends('layouts.app')

@section('title') Signin @endsection

@section('content')
@include('includes.navout')
<div class="container">
	<h2 class="text-center">Room and Appartment Rentals</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			@if(session('errormessage'))
				<div class="alert alert-danger text-center">
					<b>{{ session('errormessage') }}</b>
				</div>
			@endif
			@if(session('signin'))
				<div class="alert alert-warning text-center">
					<b>{{ session('signin') }}</b>
				</div>
			@endif
			<div class="panel panel-primary">
				<div class="panel-heading">
					<b>Signin</b>
				</div>
				<div class="panel-body">
					<form action="user_signin" method="post" role="form" autocomplete="off">
						<div class="form-group">
							<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required="required" {{ session('signin')? 'autofocus' : '' }} />
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" id="password" placeholder="Password" required="required" />
						</div>
						<div class="form-group">
							<input type="checkbox" name="remember" id="remember"/>
							<label for="remember">Remember Me?</label>
						</div>
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit" class="btn btn-primary">Login</button>
							<button type="reset" class="btn btn-danger">Clear Fields</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection