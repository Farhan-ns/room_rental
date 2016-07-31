@extends('layouts.app')

@section('title') Members @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		@foreach($members as $member)
			<div class="col-md-4">
				<div class="panel panel-default"> 
				<div class="panel-body"> 
					{{ $member->firstname }} {{ $member->lastname }}
					<br/>
					{{ $member->birthday }}
					<br/>
					{{ $member->gender }}
					<br/>
					{{ $member->mobile }}
				</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection