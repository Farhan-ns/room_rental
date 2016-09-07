<?php
    $homeactive = '';
    $aboutactive = '';
    $signinactive = '';
    $signupactive = '';
?>

@extends('layouts.app')

@section('title') Title @endsection

@section('content')
@include('includes.navout')
<div class="container guestpost">
	<div class="row" ng-app ng-init="price={{$price}}">
		<div class="col-md-8">
			<h3>{{ $title }}</h3>
			<p>{{ $type }}</p>
			<p>{{ $location }}</p>
			<p>{{ $price }}</p>
			<p>{{ $description }}</p>
			<img src="/uploads/posts/{{ $image_id }}" clas="img-responsive" />
		</div>
		<div class="col-md-4">
			<h4>Cost Calculator</h4>
			<label>Enter Month/s of Estimated Stay</label>
			<input type="number" ng-model="month" value=0 />
			<h3>Rent Cost: @{{ month * price }}</h3>
		</div>
	</div>
</div>
@endsection