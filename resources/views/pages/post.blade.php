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
	<div class="row" ng-app ng-init="price={{$post->price}}">
		<div class="col-md-8">
			<h3>{{ $post->title }}</h3>
			<p>{{ $post->type }}</p>
			<p>{{ $post->location }}</p>
			<p>{{ $post->price }}</p>
			<p>{{ $post->description }}</p>
			@foreach($post->postImage as $img)
				<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-posts responsive" /> 
			@endforeach
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