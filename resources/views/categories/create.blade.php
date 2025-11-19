@extends('layouts.app')
@section('title', $title)
@section('content')
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
                            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @include('categories.partials.category_form')
                                <button type="submit" class="btn btn-primary mx-3">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
