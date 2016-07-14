<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#appNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="javascript:void(0);">Welcome User!</a>
		</div>
		<div class="collapse navbar-collapse" id="appNavbar">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li class=""><a href="{{ route('home_user') }}">Home</a></li>
					<li class=""><a href="{{ route('search') }}">Search</a></li>
					<li class=""><a href="#">Posts</a></li>
					<li class=""><a href="#">About</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a id="dLabel" data-target="#" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						    <span class="glyphicon glyphicon-cog"></span>
						    <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" aria-labelledby="dLabel">
							<li><a href="#">User Settings</a></li>
							<li role="separator" class="divider"></li>
							<li><a href="#">Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>