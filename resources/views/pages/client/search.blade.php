@extends('layouts.app')

@section('title') Search for Rooms and Appartments @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading"><b>Search a Room/Appartment</b></div>
		<div class="panel-body">
			<form action="{{ route('searchresult') }}" method="post" role="form">
				<div class="form-group">
					<label for="room">Room</label>
					<input type="radio" name="type" id="room" value="Room" required="required" />
					<label for="appartment">Appartment</label>
					<input type="radio" name="type" id="appartment" value="Appartment" required="required" />
				</div>
				<div class="form-group">
					<label for="price">Price Range:</label>
					<div class="row" id="price">
						<div class="col-md-6">
							<input type="number" value="" name="min_price" id="min_price" class="form-control" placeholder="Minimum Price" />
						</div>
						<div class="col-md-6">
							<input type="number" value="" name="min_price" id="min_price" class="form-control" placeholder="Maximum Price" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<input type="text" value="" name="location" id="location" class="form-control" placeholder="Location" />
				</div>
				<div class="form-group">
					<input type="hidden" name="_token" value="{{ csrf_token() }" />
					<button type="submit" class="btn btn-primary">Search</button>
					<button type="reset" class="btn btn-danger">Clear Fields</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection