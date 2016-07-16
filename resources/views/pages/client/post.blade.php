@extends('layouts.app')

@section('title') {{ $title }} @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<h3>{{ $title }}</h3>
	<p>by {{ $user_fname . " " . $user_lname }}</p>
	<p>Email: {{ $user_email }}</p>
	<p>{{ $location }}</p>
	<p>{{ $price }}</p>
	<p>{{ $description }}</p>
	<img src="/uploads/posts/default.jpg" class="" alt="{{ $title }}" />

</div>
@endsection