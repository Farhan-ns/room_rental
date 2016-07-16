@extends('layouts.app')

@section('title') My Posts @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<h2 class="">My Posts</h2>
	<div class="row"> 
		@foreach($posts as $post)
		<div class="col-md-3">
			<img src="/uploads/posts/default.jpg" alt="{{ $post->title }}" class="img-posts" /> 
			{{ $post->title }}
			<br/>
			{{ $post->price }}
			<br/>
			{{ $post->description }}
			<br/>
			{{ $post->location }}
			<br/>
			<a href="#"><button class="btn btn-primary btn-xs">Edit</button></a>
			<a href="#"><button class="btn btn-danger btn-xs">Delete</button></a>
		</div>
		@endforeach
	</div>
	<div>
		{{ $posts->links() }}
	</div>
</div>
@endsection