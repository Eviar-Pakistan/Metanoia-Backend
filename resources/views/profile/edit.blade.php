@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Profile</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Profile Update Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3>{{ __('Profile Information') }}</h3>
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
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            required autofocus value="{{ old('last_name', $user->last_name) }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('Email') }}</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required value="{{ old('email', $user->email) }}">
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Password Update Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3>{{ __('Update Password') }}</h3>
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

                                    <div class="d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Account Deletion Section -->
                        <div class="card">
                            <div class="card-header text-danger">
                                <h3>{{ __('Delete Account') }}</h3>
                                <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                                </p>
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

                                    <div class="d-flex justify-content-end">
                                        <button type="button"
                                            class="btn btn-secondary me-2">{{ __('Cancel') }}</button>
                                        <button type="submit"
                                            class="btn btn-danger">{{ __('Delete Account') }}</button>
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
    </div>
@endsection
