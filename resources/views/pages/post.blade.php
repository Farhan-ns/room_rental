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
			<a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary btn-xs">Back</a>
			<h3>{{ $post->title }}</h3>
			<p>Type: <strong>{{ $post->type }}</strong></p>
			<p>Location: <strong>{{ $post->location }}</strong></p>
			<p>Price: <storng>{{ $post->price }}</storng></p>
			<p>Description: <i>{{ $post->description }}</i></p>
			<br/>
			<div class="row"> 
			@foreach($post->postImage as $img)
				<div class="col-md-6 post-img">
					<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-posts responsive circle" />
				</div>
			@endforeach
			</div>
		</div>
		<div class="col-md-4">
			<h4>Cost Calculator</h4>
			<label>Enter Month/s of Estimated Stay</label>
			<input type="number" ng-model="month" value=0 />
			<h3>Rent Cost: @{{ month * price }}</h3>
		</div>
	</div>
</div>
@include('includes.signin-register')
@endsection