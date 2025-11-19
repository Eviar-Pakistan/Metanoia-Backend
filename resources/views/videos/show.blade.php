@extends('layouts.app')

@section('title', $title)

@section('content')

<div class="content-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $title }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Title:</strong> {{ $video->title }}
                                </div>
                                <div class="mb-3">
                                    <strong>Category:</strong> {{ $video->category->name }}
                                </div>
                                <div class="mb-3">
                                    <strong>Image:</strong>
                                    <img src="{{ asset('storage/app/public/' . $video->image) }}" alt="{{ $video->title }}" width="100">
                                </div>
                                <div class="mb-3">
                                    <strong>Video:</strong>
                                    @if ($video->video)
                                        <video width="100%" controls>
                                            <source src="{{ asset('storage/app/public/' . $video->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    @else
                                        No video available
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('videos.index') }}" class="btn btn-secondary mt-4">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
