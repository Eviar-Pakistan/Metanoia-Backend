<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscriptions</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Subscriptions</h1>
        <div class="row">
            @foreach ($subscriptions as $subscription)
            @php
                $details = json_decode($subscription->details, true);
                $stuff = implode(", ", $details);
            @endphp
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $subscription->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">${{ $subscription->price }}</h6>
                            <p class="card-text">{{ $stuff }}</p>
                            <p class="card-text"><small class="text-muted">Duration: {{ $subscription->duration }} days</small></p>
                            <form action="{{ route('paypal') }}" method="GET">
                                <input type="hidden" name="id" value="{{ $subscription->id }}">
                                <button type="submit" class="btn btn-primary">Pay</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
