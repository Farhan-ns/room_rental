@extends('layouts.app')

@section('title') Search for Rooms and Appartments @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Search a Room/Appartment</div>
		<div class="panel-body">
			<form action="#" method="post" role="form">
				<div class="form-group">
					<label for="room">Room</label>
					<input type="radio" name="type" id="room" checked="checked" />
					<label for="appartment">Appartment</label>
					<input type="radio" name="type" id="appartment" />
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
@endsection