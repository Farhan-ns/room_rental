@extends('layouts.app')

@section('title') Inquiry @endsection

@section('content')
<div class="contianer">
	<h2>Name: {{ $user }}</h4>
	<h4>Email: {{ $email }}</h4>
	<h4>Mobile #: {{ $mobile }}</h4>

	<h4>{{ $msg }}</h4>

	<div class="panel panel-default">
		<h2>{{ $post_type }}<br/>
		{{ $post_address }}<br/>
		{{ $post_price }}</h2>
	</div>

	<br/><br/>
	<span style="color:red;"><i>Powered by SparkPost</i></span>
</div>
@endsection