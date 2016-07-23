@extends('layouts.app')

@section('title') Search Result @endsection

@section('content')
@include('includes.navin')
<div class="container">

	<div class="row">
		@if($posts->isEmpty())
			<h3>No Result for your search</h3>
			<p>Back to <a href="{{ route('search') }}">search</a></p>
		@endif
		@foreach($posts as $post)
		<div class="col-md-3 post">
			<a href="{{ route('post', ['id' => $post->id]) }}">
			<img src="/uploads/posts/default.jpg" title="" class="img-posts" />
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