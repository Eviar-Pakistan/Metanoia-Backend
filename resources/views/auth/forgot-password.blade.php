<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHYSIO-VR | Forgot Password</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/favicon.ico') }}"/>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('public/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/remixicon/fonts/remixicon.css') }}">
</head>
<body class="" style="background: #2975af;">
<!-- loader Start -->
<div id="loading">
    <div id="loading-center"></div>
</div>
<!-- loader END -->

<div class="wrapper">
    <section class="login-content">
        <div class="container">
            <div class="row align-items-center justify-content-center height-self-center">
                <div class="col-lg-8">
                    <div class="card auth-card">
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center auth-content">
                                <div class="col-lg-7 align-self-center">
                                    <div class="p-3">
                                        <h2 class="mb-2">Forgot Password</h2>
                                        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                                        <!-- Session Status -->
                                        <x-auth-session-status class="mb-4" :status="session('status')" />

                                        <form method="POST" action="{{ route('password.email') }}">
                                            @csrf

                                            <!-- Email Address -->
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                   <input class="floating-input form-control" id="email" type="email" name="email" placeholder=" " :value="old('email')" required autofocus autocomplete="username">
                                                   <label>Email</label>
                                                   <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                                </div>
                                             </div>

                                            <div class="flex items-center justify-end mt-4">
                                                <button type="submit" class="btn btn-primary mx-3">{{ __('Email Password Reset Link') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-lg-5 content-right">
                                    <img src="{{ asset('public/assets/images/login/01.png') }}" class="img-fluid image-right" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Backend Bundle JavaScript -->
<script src="{{ asset('public/assets/js/backend-bundle.min.js') }}"></script>

<!-- Table Treeview JavaScript -->
<script src="{{ asset('public/assets/js/table-treeview.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script src="{{ asset('public/assets/js/customizer.js') }}"></script>

<!-- Chart Custom JavaScript -->
<script async src="{{ asset('public/assets/js/chart-custom.js') }}"></script>

<!-- app JavaScript -->
<script src="{{ asset('public/assets/js/app.js') }}"></script>
</body>
</html>
