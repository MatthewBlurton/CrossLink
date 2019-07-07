@extends('layouts.app')

@section('breadcrumbs')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container">
    {{-- <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data"> --}}
    <div class="row">
        <div class="col">
            @component('components.errors')
            <strong>Whoops!</strong> Could not update your account for the following reasons.
            @endcomponent
        </div>
    </div>
    <div class="row">
        <div class="col">
            @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif
        </div>
    </div>

    {{-- User settings section --}}
    @can('edit users')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">User Settings</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @method("PATCH")
                        @csrf

                        {{-- Name input disabled --}}
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        {{-- Email input disabled --}}
                        <div class="form-group row">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" value="{{ $user->email }}" disabled>
                            </div>
                        </div>

                        @if(auth()->user()->id === $user->id)
                        {{-- Old Password input --}}
                        <div class="form-group row">
                            <label for="old-password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>
                            <div class="col-md-6">
                                <input id="old-password" type="password" id="old-password"
                                    class="form-control @error('password') is-invalid @enderror" name="old-password"
                                    autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password input --}}
                        <div class="form-group row">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Password confirm input --}}
                        <div class="form-group row">
                            <label for="password_confirmation"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Submit form --}}
                        <div class="form-group-row">
                            <div class="offset-md-2 col-md-8">
                                <button type="submit" class="btn btn-primary btn-block">Reset Password</a>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endcan
    {{-- End user settings section --}}

    {{-- Profile settings section --}}
    @can('edit profiles')
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Settings</div>
                <div class="card-body">
                    <form action="{{ route('profiles.update', $user) }}" method="post" enctype="multipart/form-data">
                        @method("PATCH")
                        @csrf
                        {{-- First name --}}
                        <div class="form-group row">
                            <label for="first_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="first_name" id="first_name"
                                    class="form-control @error('first_name')is-invalid @enderror"
                                    value="{{ old('first_name') ? old('first_name') : $user->profile->first_name }}"
                                    required autocomplete="name">

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Family name --}}
                        <div class="form-group row">
                            <label for="family_name"
                                class="col-md-4 col-form-label text-md-right">{{ __('Family Name') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="family_name" id="family_name"
                                    class="form-control @error('family_name')is-invalid @enderror"
                                    value="{{ old('family_name') ? old('family_name') : $user->profile->family_name }}"
                                    required autocomplete="name">

                                @error('family_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Avatar --}}
                        <div class="form-group row">
                            <div class="input-group col-md-8 mx-auto">
                                <div class="custom-file">
                                    {{-- <input type="file" name="avatar" id="avatar" class="custom-file-input">
                                    <label for="avatar" class="custom-file-label">Avatar</label> --}}
                                    <input type="file" class="form-control-file" name="avatar" id="avatarFile"
                                        aria-describedby="fileHelp">
                                    <small id="fileHelp" class="form-text text-muted">Please upload a valid image file.
                                        Size of image should not be more than 2MB.</small>
                                </div>
                            </div>
                        </div>

                        {{-- Social --}}
                        <div class="form-group row">
                            <label for="social"
                                class="col-md-4 col-form-label text-md-right">{{ __('Social Media Link') }}</label>
                            <div class="col-md-6">
                                <input type="text" name="social" id="social"
                                    class="form-control @error('social')is-invalid @enderror"
                                    value="{{ old('social') ? old('social') : $user->profile->social }}"
                                    autocomplete="url">

                                @error('social')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Apply</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endcan
    {{-- End profile section --}}

    {{-- Admin section --}}
    @auth
    @if(auth()->user()->can('assignRole', $user) || auth()->user()->can('suspend', $user))
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Options</div>
                <div class="card-body">

                    @can('assignRole', $user)
                    <form action="{{ route('users.update.role', $user) }}" method="post">
                        @method("PATCH")
                        @csrf
                        <div class="form-group row">
                            <div class="col-md-8 mx-auto">
                                <select name="role" id="roles" class="custom-select">
                                    @can('access all accounts')
                                    <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                                    <option value="user-admin" @if($user->hasRole('user-admin')) selected @endif>User Admin</option>
                                    <option value="user" @if($user->hasRole('user')) selected @endif>User</option>
                                    @else
                                    <option value="user" @if($user->hasRole('user')) selected @endif>User</option>
                                    <option value="user-admin" @if($user->hasRole('admin')) selected @endif>User Admin</option>
                                    @endcan
                                </select>
                            </div>
                        </div>
                        <div class="form-group-row mb-3">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-primary btn-block">Change Role</button>
                            </div>
                        </div>
                    </form>
                    @endcan

                    @can('suspend', $user)
                    <form action="{{ route('users.suspend', $user) }}" method="post">
                        @method("DELETE")
                        @csrf
                        <div class="form-group-row">
                            <div class="col-md-8 offset-md-2">
                                @if(!$user->hasRole('suspended'))
                                <button type="submit" class="btn btn-danger btn-block">Suspend user</button>
                                @else
                                <button type="submit" class="btn btn-success btn-block">Remove Suspension</button>
                                @endif
                            </div>
                        </div>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    @endif
    @endauth
</div>
@endsection
