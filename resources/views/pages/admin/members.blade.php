@extends('layouts.app')

@section('title') Members @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table table-hover">
				<thead>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Birthday</th>
				</tr>
				</thead>
				<tbody>
				@foreach($members as $member)
				<tr>
					<td>{{ $member->firstname . ' ' . $member->lastname }}</td>
					<td>{{ $member->email }}</td>
					<td>{{ $member->mobile }}</td>
					<td>{{ $member->birthday }}</td>
				</tr>
				@endforeach
				</tbody>
			</table>
			{{ $members->render() }}
		</div>
	</div>
</div>
@endsection