@extends('layouts.app')

@section('title') Home @endsection

@section('content')
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:void(0);">Rental</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="active"><a href="{{ route('home') }}">Home</a></li>
					<li class=""><a href="{{ route('about') }}">About</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Signin</a></li>
					<li><a href="#">Signup</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<div class="container">
	<h2 class="text-center">Appartment and Room Rentals</h2>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">Search</div>
				<div class="panel-body">
					<form action="#" method="post" role="form">
						<div class="form-group">
							<label for="appartment">Appartment</label>
							<input type="radio" name="type" id="appartment" checked="checked" />
							<label for="room">Room</label>
							<input type="radio" name="type" id="room" />
						</div>
						<div class="form-group">
							<label for="price">Price Range:</label>
							<div class="row" id="price">
								<div class="col-md-6">
									<input type="number" value="" name="min_price" id="min_price" class="form-control" placeholder="Minimum Price" required="required" />
								</div>
								<div class="col-md-6">
									<input type="number" value="" name="min_price" id="min_price" class="form-control" placeholder="Maximum Price" required="requied" />
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="location">Location</label>
							<input type="text" value="" name="location" id="location" class="form-control" placeholder="Location" required="required" />
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Search</button>
							<button type="reset" class="btn btn-danger">Clear Fields</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection