@extends('layouts.app')

@section('title') Active Posts @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		@if($posts->isEmpty())
			<h3>No Available Active Posts</h3>
		@endif
		@foreach($posts as $post)
		<div class="col-md-3 post">
			<div class="panel panel-default">
				<div class="panel-body">
					<h3>{{ $post->title }}</h3>
				
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
						<tr>
							<td>Created:</td>
							<td>{{ date('m-d-Y',strtotime($post->created_at)) }}</td>
						</tr>
						<tr>
							<td>Modified:</td>
							<td>{{ date('m-d-Y',strtotime($post->updated_at)) }}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		@endforeach
	</div>

	{{ $posts->links() }}
	</div>
</div>
@endsection