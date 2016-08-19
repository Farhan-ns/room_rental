@extends('layouts.app')

@section('title') Admid Dashboard @endsection

@section('content')
@include('pages.admin.adminnav')
<div class="container">
@include('includes.showsuccess')
<h2>Admin</h2>
</div>
@endsection