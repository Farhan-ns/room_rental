@extends('layouts.app')

@section('title') Signin @endsection

@section('content')
@include('includes.navout')
<div class="container">
	<h2 class="text-center">Room and Appartment Rentals</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Signin
				</div>
				<div class="panel-body">
					<form action="#" method="post" role="form">
						<div class="form-group">
							<input type="text" class="form-control" name="email" id="email" placeholder="Email" required="required" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="password" id="password" placeholder="Password" required="required" />
						</div>
						<div class="form-group">
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