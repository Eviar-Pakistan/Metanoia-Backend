@extends('layouts.app')
@section('title', __('Profile'))

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ __('Profile') }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Profile Information Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>{{ __('Profile Information') }}</h5>
                                <p>{{ __("Update your account's profile information and email address.") }}</p>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('profile.update') }}">
                                    @csrf
                                    @method('patch')

                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            required autofocus value="{{ old('first_name', $user->first_name) }}">
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            required autofocus value="{{ old('last_name', $user->last_name) }}">
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required value="{{ old('email', $user->email) }}">
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Update Password Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>{{ __('Update Password') }}</h5>
                                <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')

                                    <div class="mb-3">
                                        <label for="current_password"
                                            class="form-label">{{ __('Current Password') }}</label>
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">{{ __('New Password') }}</label>
                                        <input type="password" class="form-control" id="new_password" name="password"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password_confirmation"
                                            class="form-label">{{ __('Confirm Password') }}</label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" required>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete Account Section -->
                        <div class="card">
                            <div class="card-header text-danger">
                                <h5>{{ __('Delete Account') }}</h5>
                                <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}</p>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('profile.destroy') }}">
                                    @csrf
                                    @method('delete')

                                    <div class="mb-3">
                                        <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required>
                                    </div>

                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button type="button" class="btn btn-secondary me-2"
                                            data-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
