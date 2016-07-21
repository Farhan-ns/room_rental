@extends('layouts.app')

@section('title') Change Password @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<h2>Change Password</h2>
	@include('includes.showerrors')
	@include('includes.showerror')
	@include('includes.showsuccess')
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<b>Change Password</b>
				</div>
				<div class="panel-body">
					<form action="{{ route('updatepass') }}" method="POST" role="form" autocomplete="off">
						<div class="form-group">
							<input type="password" name="old_password" id="old_password" class="form-control" placeholder="Current Password" required="" />
						</div>
						<div class="form-group">
							<input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required="" />
						</div>
						<div class="form-group">
							<input type="password" name="new_password2" id="new_password2" class="form-control" placeholder="Re Enter New Password" required="" />
						</div>
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
							<button type="submit" class="btn btn-primary">Apply Change</button>
							<button type="reset" class="btn btn-danger">Clear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection