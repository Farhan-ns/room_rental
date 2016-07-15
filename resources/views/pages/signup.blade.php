@extends('layouts.app')

@section('title') Signup @endsection

@section('content')
@include('includes.navout')
<div class="container">
	<h2 class="text-center">Room and Appartment Rentals</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					Signup
				</div>
				<div class="panel-body">
					<form action="user_signup" method="POST" role="form">
						<div class="form-group">
							<input type="text" name="email" id="email" placeholder="Email" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="text" name="firstname" id="firstname" placeholder="First Name" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="text" name="lastname" id="lastname" placeholder="Last Name" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="text" name="bday" id="bday" placeholder="Birth Day" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<label for="gender-male">Male</label>
							<input type="radio" name="gender" id="gender-male" value="Male" />
							<label for="gender-female">Female</label>
							<input type="radio" name="gender" id="gender-female" value="Female" />
						</div>
						<div class="form-group">
							<input type="text" name="mobile" id="mobile" placeholder="Mobile Number" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="password" name="password" id="password" placeholder="Password" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="password" name="password2" id="password2" placeholder="Re-enter Password" required="required" class="form-control" />
						</div>
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="submit" class="btn btn-primary">Singup</button>
							<button type="reset" class="btn btn-danger">Clear Fields</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection