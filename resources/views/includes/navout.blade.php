<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:void(0);">Welcome Guest!</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class="{{ $homeactive }}"><a href="{{ route('home') }}">Home</a></li>
					<li class="{{ $aboutactive }}"><a href="{{ route('about') }}">About</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="{{ $signinactive }}"><a href="{{ route('signin') }}">Signin</a></li>
					<li class="{{ $signupactive }}"><a href="{{ route('signup') }}">Signup</a></li>
				</ul>
			</div>
		</div>
	</div>
</nav>