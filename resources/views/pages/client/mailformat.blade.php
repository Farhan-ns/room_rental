@extends('layouts.app')

@section('title') Inquiry @endsection

@section('content')
<div class="contianer">
	<p>
		Name: {{ $user }}
		Email: {{ $email }}
		Mobile #: {{ $mobile }}
	</p>

	<p>Message: {{ $msg }}</p>

	<p>
		{{ $post_type }}
		{{ $post_address }}
		{{ $post_price }}
	</p>

	<br/><br/>
	<span style="color:red;"><i>Powered by SparkPost</i></span>
</div>
@endsection