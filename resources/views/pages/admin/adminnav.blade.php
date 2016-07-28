<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('home_user') }}">Welcome Admin!</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="{{ route('admin_home') }}">Home</a></li>
					<li><a href="#">Members</a></li>
					<li><a href="{{ route('pending-posts') }}">Pending Posts</a></li>
					
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    <span class="glyphicon glyphicon-cog"></span>
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="#">Admin Profile</a></li>
							<li><a href="#">Change Password</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="{{ route('logout') }}">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>