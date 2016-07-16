@extends('layouts.app')

@section('title') Browse Rooms and Appartments @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<h2>Browse Rooms and Appartments</h2>

	<div class="row">
		
		@foreach($posts as $post)
		<div class="col-md-3">
			<img src="/uploads/posts/default.jpg" title="" class="img-posts" />
			<h3><a href="{{ route('post', ['id' => $post->id]) }}">{{ $post->title }}</a></h3>
			<i>{{ $post->location }}</i>
			<br/>
			<b>{{ $post->price }}</b>
			<br/>
			{{ $post->description }}
		</div>
		@endforeach
	</div>

	{{ $posts->links() }}
</div>
@endsection