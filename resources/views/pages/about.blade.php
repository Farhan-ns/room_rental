@extends('layouts.app')

@section('title') About @endsection

@section('content')
@yield('navigation')

<div class="container">
<div class="about">
<div class="ownpic">

	<br/><br/><br/>
	<h2>Neofita Apartelle & Rooms Advertisement And Informtion System</h2>
	<br>
	<p class="p-indent"><img src="img_avatar_g.jpg" height="50px" alt="Me"></img> Neofita Apartelle & Rooms Advertisement And Informtion System is a small and wildly ambitious startup tackling a problem that affects over Millions renters across the Philippines.We believe that renters shouldn't engage with technology only to search for their next home or apartment rental.</p>
	<p class="p-indent">We believe that you should be able to walk into an open house or appointment, pull out your phone, and make a binding application and offer for that unit right there. This is how the next generation of the rental market will function, and Neofita Apartelle & Rooms Adverticement And Informtion System  — with a unique twinned B2B (business-to-business) and Consumer approach — is leading the way.</p>
	</div>
	</div>
</div>

@include('includes.signin-register')

@endsection

