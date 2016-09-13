@extends('layouts.app')

@section('title') Browse Rooms and Appartments @endsection

@section('content')
@include('includes.navin')
<div class="container">

	<div class="row">
		<br/><br/>
		@if(count($posts) < 1)
			<h3>No Available Post</h3>
		@endif
		@foreach($posts as $post)
		<div class="col-md-3 post">
			<a href="{{ route('post', ['id' => $post->id]) }}">
			@foreach($post->postImage as $img)
				<img src="/uploads/posts/{{ $img->name }}" alt="{{ $post->title }}" class="img-posts" /> 
				@break
			@endforeach
			<h3>{{ $post->title }}</h3>
			</a>
			<table class="table">
				<tr>
					<td>Type:</td>
					<td>{{ $post->type }}</td>
				</tr>
				<tr>
					<td>Price:</td>
					<td>{{ $post->price }}</td>
				</tr>
				<tr>
					<td>Location:</td>
					<td>{{ $post->location }}</td>
				</tr>
			</table>
		</div>
		@endforeach
	</div>

	{{ $posts->links() }}
</div>
@endsection