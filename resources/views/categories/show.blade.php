@extends('layouts.app')

@section('title', 'Category Details')

@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Category Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Name:</strong> {{ $category->name }}
                                </div>
                                <div class="mb-3">
                                    <strong>Image:</strong>
                                    <img src="{{ asset('storage/app/public/'.$category->image) }}" alt="{{ $category->name }}" width="100">
                                </div>
                                <div class="mb-3">
                                    <strong>Subscriptions:</strong>
                                    @if($category->subscriptions)
                                    @foreach ($category->subscriptions as $subscription)
                                        <span class="badge badge-primary">{{ $subscription->name }}</span>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('category.index') }}" class="btn btn-secondary mt-4">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
