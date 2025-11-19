@extends('layouts.app')
@section('content')
@section('title', 'Device Details')

<div class="content-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Device Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Title:</strong> {{ $device->title }}
                                </div>
                                <div class="mb-3">
                                    <strong>IP Address:</strong> {{ $device->ip_address }}
                                </div>
                                <div class="mb-3">
                                    <strong>MAC Address:</strong> {{ $device->mac_address }}
                                </div>
                                <div class="mb-3">
                                    <strong>Status:</strong>
                                    @if ($device->status == 1)
                                        <span class="badge bg-success">Connected <i class="bi bi-wifi"></i></span>
                                    @else
                                        <span class="badge bg-danger">Disconnected <i class="bi bi-wifi-off"></i></span>
                                    @endif

                                </div>

                            </div>
                        </div>
                        <a href="{{ route('devices.index') }}" class="btn btn-secondary mt-4">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
