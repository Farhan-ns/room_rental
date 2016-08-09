<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home_user') }}">M R&amp;A</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class=""><a href="{{ route('home_user') }}">Home</a></li>
					<li class=""><a href="{{ route('browse') }}">Browse Posts</a></li>
					<li class=""><a href="{{ route('search') }}">Search</a></li>
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    My Posts
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('addpost') }}">Add Post</a></li>
							<li><a href="{{ route('myposts') }}">View Posts</a></li>
							<li><a href="{{ route('showposttodelete') }}">Delete</a></li>
						</ul>
					</li>
					<li class=""><a href="{{ route('client_about') }}">About</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    <img src="/uploads/profiles/{{ Auth::user()->profile }}" style="width:20px; height:20px;border-radius: 50%;">
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="{{ route('profile') }}">User Profile</a></li>
							<li><a href="{{ route('changepass') }}">Change Password</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>