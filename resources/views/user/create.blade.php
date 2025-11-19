@extends('layouts.app')
@section('content')
@section('title', $title)
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" id="createWorkoutForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body row">
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName">First Name <span style="color: red">*</span></label>
                                    <input type="text" name="first_name" required class="form-control"
                                        id="exampleInputName" placeholder="Enter First Name">
                                        <span style="color: red" class="m-1 mb-1">{{$errors->first('first_name')}}</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName">Last Name <span style="color: red">*</span></label>
                                    <input type="text" name="last_name" required class="form-control"
                                        id="exampleInputName" placeholder="Enter Last Name">
                                        <span style="color: red" class="m-1 mb-1">{{$errors->first('last_name')}}</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName">Email <span style="color: red">*</span></label>
                                    <input type="emial" name="email" required class="form-control"
                                        id="exampleInputName" placeholder="Enter Email">
                                        <span style="color: red" class="m-1 mb-1">{{$errors->first('email')}}</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName">Password <span style="color: red">*</span></label>
                                    <input type="password" name="password" class="form-control" id="exampleInputName"
                                        placeholder="Enter Password" required>
                                        <span style="color: red" class="m-1 mb-1">{{$errors->first('password')}}</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName">Confirm Password <span
                                            style="color: red">*</span></label>
                                    <input type="password" name="cpassword" class="form-control" id="exampleInputName"
                                        placeholder="Enter Confirm Password" required>
                                        <span style="color: red" class="m-1 mb-1">{{$errors->first('cpassword')}}</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="exampleInputName">Roles <span style="color: red">*</span></label>
                                    <select name="role_id" id="exampleInputName" class="form-control" required>
                                        <option value="" selected disabled>--Select Role--</option>
                                        @if ($roles)
                                            @foreach ($roles as $val)
                                                <option value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="">--No Role Found--</option>
                                        @endif
                                    </select>
                                    <span style="color: red" class="m-1 mb-1">{{$errors->first('role_id')}}</span>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="image">Profile Image </label>
                                    <input type="file" name="image" class="form-control pt-2"  required id="image">
                                    <span style="color: red" class="m-1 mb-1">{{$errors->first('profile_image')}}</span>

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
