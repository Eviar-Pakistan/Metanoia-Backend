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
                        <form action="{{ route('subscription.store') }}" method="POST">
                            @csrf
                            @include('subscriptions.partials.subscription_form')
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Add offer dynamically
    $(document).ready(function() {
        $('.add-offer').click(function() {
            var html = '<div class="form-group offer-item">' +
                            '<label for="offer">Offer</label>' +
                            '<input type="text" class="form-control" name="offers[]" required>' +
                            '<button type="button" class="btn btn-sm btn-danger remove-offer">-</button>' +
                        '</div>';
            $('#offers-container').append(html);
        });

        // Remove offer dynamically
        $(document).on('click', '.remove-offer', function() {
            $(this).closest('.offer-item').remove();
        });
    });
</script>

@endsection
