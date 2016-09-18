@extends('layouts.app')

@section('title') Read Message @endsection

@section('content')
@include('includes.navin')
<div class="container-fluid">
	<br/><br/><br/>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<a href="{{ route('inbox') }}" class="btn btn-primary btn-xs">Back to Inbox</a>
			<br/><br/>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<strong>Message Details</strong>
				</div>
				<div class="panel-body">
					<?php 
						$sender = App\User::find($message->sender);
					?>
					<p>Sender: <strong><a href="{{ route('profile') }}">{{ $sender->firstname . ' ' . $sender->lastname}}</a></strong></p>
					<p>Email: <strong>{{ $sender->email }}</strong></p>
					<p>Mobile: <strong>{{ $sender->mobile }}</strong></p>
					<p>Message: <i>{{ $message->message }}</i></p>
					<br/>
					<?php
						$post = App\Post::find($message->post_id);
					?>
					<p>Post Title: <strong>{{ $post->title }}</strong></p>
					<br/>
					<p>Date Send: <strong>{{ $message->created_at }}</strong></p>
					
				</div>
			</div>
		</div>
	</div>

</div>
@endsection