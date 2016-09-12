@extends('layouts.app')

@section('title') {{ $title }} @endsection

@section('content')
@include('includes.navin')
<div class="container postrest">
	<a href="#">Back</a>
	<div class="row">
	@include('includes.showsuccess')
	@include('includes.showerrors')
		<div class="col-md-8" ng-app ng-init="price={{ $price }}" >
			<div class="row">
				<div class="col-md-8">
					<h3>{{ $title }}</h3>
					<p>by <a href="{{ route('post-user-profile', $user_id) }}" target="_blank">{{ $user_fname . " " . $user_lname }}</a></p>
					<p>Email: {{ $user_email }}</p>
					<p>Mobile: {{ $user_mobile }}</p>
					<p>Type:  {{ $type }}</p>
					<p>Location:  {{ $location }}</p>
					<p>Price:  {{ $price }}</p>
					<p>Dexcription:  {{ $description }}</p>
				</div>
				<div class="col-md-4">
					<label>Month of Stay:</label>
					<input type="number" name="number" id="number" value=0 ng-model="month_num" />
					<!-- <input type="hidden" name="value" value={{ $price }} ng-model="price" /> -->
					<h3>Estimated Cost: @{{ month_num * price }}</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 post-img">
					<img src="/uploads/posts/{{ $image_id }}" class="img-responsive" alt="{{ $title }}" />
				</div>
			</div>

		</div>
		<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
					<b>Send Message to Owner</b>
				</div>
				<div class="panel-body">
					<form action="{{ route('send_msg_post_owner') }}" method="POST" role="form">
						<div class="form-group">
							<input type="text" name="title" id="title" class="form-control uppercase" value="{{ $title }} @ {{ $location }}" readonly="" />
						</div>	
<!-- 						<div class="form-group">
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" required="" />
						</div>
						<div class="form-group">
							<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number" required="" />
						</div>
						<div class="form-group">
							<input type="text" name="email" id="email" class="form-control" placeholder="Email" required="" />
						</div> -->
						<div class="form-group">
						<textarea class="form-control" rows="10" name="message" id="message" placeholder="You message here..." required=""></textarea>
						</div>
						<div class="form-group text-right">
							<input type="hidden" name="id" value="{{ $id }}" />
							<input type="hidden" name="post_id" value="{{ $post_id }}" />
							<input type="hidden" name="_token" value="{{ csrf_token() }}" />
							<button type="sumbit" class="btn btn-info">Send</button>
							<button type="reset" class="btn btn-info">Clear</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection