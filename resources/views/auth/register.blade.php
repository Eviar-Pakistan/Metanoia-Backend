<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>PHYSIO-VR | Signup</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('public/assets/images/favicon.ico')}}"/>
      <link rel="stylesheet" href="{{asset('public/assets/css/backend-plugin.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/assets/css/backend.css?v=1.0.0')}}">
      <link rel="stylesheet" href="{{asset('public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css')}}">
      <link rel="stylesheet" href="{{asset('public/assets/vendor/remixicon/fonts/remixicon.css')}}">
  <body class=" "  style="background: #2975af;">
    <!-- loader Start -->
    <div id="loading">
          <div id="loading-center">
          </div>
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
                                 <h2 class="mb-2">Sign Up</h2>
                                 <p>Create your PHYSIO-VR account.</p>
                                 <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row">
                                       <div class="col-lg-6">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" id="first_name" type="text" name="first_name" placeholder=" " :value="old('first_name')" required autofocus autocomplete="first_name">
                                             <label>First Name</label>
                                             <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                        <div class="floating-label form-group">
                                           <input class="floating-input form-control" id="last_name" type="text" name="last_name" placeholder=" " :value="old('last_name')" required autofocus autocomplete="last_name">
                                           <label>Last Name</label>
                                           <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                        </div>
                                     </div>
                                       <!-- No Last Name in default Laravel Breeze -->
                                       <div class="col-lg-12">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" id="email" type="email" name="email" placeholder=" " :value="old('email')" required>
                                             <label>Email</label>
                                             <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                          </div>
                                       </div>
                                       <!-- Phone Number is not a default field in Laravel Breeze, you'll need to add it manually to your User model and migration -->
                                       <div class="col-lg-6">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" id="password" name="password" placeholder=" " required autocomplete="new-password">
                                             <label>Password</label>
                                             <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                          </div>
                                       </div>
                                       <div class="col-lg-6">
                                          <div class="floating-label form-group">
                                             <input class="floating-input form-control" type="password" id="password_confirmation" name="password_confirmation" placeholder=" " required autocomplete="new-password">
                                             <label>Confirm Password</label>
                                          </div>
                                       </div>
                                       <div class="col-lg-12">
                                          <div class="custom-control custom-checkbox mb-3">
                                             <input type="checkbox" class="custom-control-input" id="terms">
                                             <label class="custom-control-label" for="terms">I agree with the terms of use</label>
                                          </div>
                                       </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign Up</button>
                                    <p class="mt-3">
                                       Already have an Account <a href="{{route('login')}}" class="text-primary">Sign In</a>
                                    </p>
                                 </form>
                              </div>
                           </div>
                           <div class="col-lg-5 content-right">
                              <img src="{{asset('public/assets/images/login/01.png')}}" class="img-fluid image-right" alt="">
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
    <script src="{{asset('public/assets/js/backend-bundle.min.js')}}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{asset('public/assets/js/table-treeview.js')}}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{asset('public/assets/js/customizer.js')}}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{asset('public/assets/js/chart-custom.js')}}"></script>

    <!-- app JavaScript -->
    <script src="{{asset('public/assets/js/app.js')}}"></script>
  </body>
</html>
