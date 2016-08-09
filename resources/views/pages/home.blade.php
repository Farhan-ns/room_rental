@extends('layouts.app')

@section('title') Home @endsection

@section('content')
@include('includes.navout')
<div class="container">
	<h2 class="text-center">Welcome to Maro Room and Apartel</h2>
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<form action="{{ route('guest-search') }}" method="POST" role="form">
				<div class="form-group">
					<div class="input-group">
						<input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button class="btn btn-primary" type="submit">Go!</button>
						</span>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection