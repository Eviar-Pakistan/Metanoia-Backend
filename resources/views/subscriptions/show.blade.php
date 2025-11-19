@extends('layouts.app')
@section('title', $title)
@section('content')

<div class="content-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Subscription Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Name:</strong> {{ $subscription->name }}
                                </div>
                                <div class="mb-3">
                                    <strong>Price:</strong> {{ $subscription->price }}
                                </div>
                                <div class="mb-3">
                                    <strong>Details:</strong>
                                    @if ($subscription->details)
                                        @php
                                            $details = json_decode($subscription->details, true);
                                            $detailsStr = implode(", ", $details);
                                        @endphp
                                        {{ $detailsStr }}
                                    @else
                                        No details available
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('subscription.index') }}" class="btn btn-secondary mt-4">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
