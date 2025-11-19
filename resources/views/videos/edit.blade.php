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
                        <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('videos.partials.video_form', ['video' => $video])
                            <button type="submit" class="btn btn-primary mx-3">Update</button>
                            <a href="{{ route('videos.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

