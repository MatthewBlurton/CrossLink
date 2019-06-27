@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Users</h1>
			</div>
		</div>
		<div class="row">
			@foreach($users as $aUser)
			@php($profile = $aUser->profile)
			<div class="col-sm-6 col-md-4 col-lg-3">
				<div class="card mb-4">
				  {{-- @if($profile->avatar)
				  <img class="card-img-top" src="{{ $profile->avatar }}" alt="User avatar">
				  @endif --}}
				  <div class="card-body">
				    <a href="users/{{ $aUser->id }}"><h5 class="card-title">{{ $aUser->name }}</h5></a>
				    <p class="card-text">{{ $profile->first_name }}, {{ $profile->last_name }}</p>
				  </div>
				  <div class="card-body">
				    <a href="mailto://{{ $aUser->email }}" class="card-link">{{ $aUser->email }}</a>
				  </div>

				  @if($profile->social)
				  <div class="card-body">
				    <a href="{{ $profile->social }}">{{ $profile->social }}</a>
				  </div>
				  @endif

				  {{-- if the user has permission to access all users or write to users display an option to modify the user --}}
				  @can('access all users')
				  	<div class="card-footer">
						  <a href="users/{{ $aUser->id }}/edit" class="btn btn-primary">Modify</a>
					</div>
				  @endcan
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection