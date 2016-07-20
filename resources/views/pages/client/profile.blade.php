@extends('layouts.app')

@section('title') User Profile @endsection

@section('content')
@include('includes.navin')
<div class="container">
	<h2 class="">My Profile</h2>
	<img src="/uploads/profiles/{{ Auth::user()->profile }}.jpg" class="user-profile-img" alt="{{ Auth::user()->firstname }}" />
	<br/>
	{{ Auth::user()->firstname }}
	{{ Auth::user()->lastname }}
	<br/>
	{{ Auth::user()->email }}
	<br/>
	{{ Auth::user()->mobile }}
	<br/>
	{{ Auth::user()->birthday }}
	<br/>
	{{ Auth::user()->gender }}
	<br/>
	{{ Auth::user()->privelege }}

</div>
@endsection