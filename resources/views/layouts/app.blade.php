<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PHYSIO-VR | @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/public/assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('/public/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="{{ asset('/public/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        .form-control {
            line-height: 25px !important;
        }

        a {
            text-decoration: none !important;
        }

        .table-responsive::-webkit-scrollbar {
            height: 12px;
            /* Set the height of the horizontal scrollbar */
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background-color: #f1f1f1;
            /* Change this to the desired color for the thumb */
        }

        .table-responsive::-webkit-scxarollbar-track {
            background-color: #f1f1f1;
            /* Change this to the desired color for the track */
        }

        .table-responsive::-webkit-scrollbar {
            height: 6px;
            /* Set the height of the horizontal scrollbar */
        }
        a#datatable_previous {
    width: 70px;
}

div#datatable_paginate {
    width: 100%;
}

a#datatable_next {
   width: 70px;

}
    </style>
</head>

<body class="  ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        @include('components.sidebar')

        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                        <i class="ri-menu-line wrapper-menu"></i>
                        <a href="{{ route('dashboard') }}" class="header-logo">
                            {{-- <img src="{{ asset('public/assets/images/logo.png') }}" class="img-fluid rounded-normal"
                                alt="logo"> --}}
                            <h5 class="logo-title ml-3">PHYSIO-VR</h5>
                        </a>
                    </div>
                    {{-- <div class="iq-search-bar device-search">
                        <form action="#" class="searchbox">
                            <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                            <input type="text" class="text search-input" placeholder="Search here...">
                        </form>
                    </div> --}}
                    <div class="d-flex align-items-center">
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-label="Toggle navigation">
                            <i class="ri-menu-3-line"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                                {{-- <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle btn border add-btn"
                                        id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <img src="{{ asset('public/assets/images/small/flag-01.png') }}" alt="img-flag"
                                            class="img-fluid image-flag mr-2">En
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-3">
                                                <a class="iq-sub-card" href="#"><img
                                                        src="{{ asset('public/assets/images/small/flag-02.png') }}"
                                                        alt="img-flag" class="img-fluid mr-2">French</a>
                                                <a class="iq-sub-card" href="#"><img
                                                        src="{{ asset('public/assets/images/small/flag-03.png') }}"
                                                        alt="img-flag" class="img-fluid mr-2">Spanish</a>
                                                <a class="iq-sub-card" href="#"><img
                                                        src="{{ asset('public/assets/images/small/flag-04.png') }}"
                                                        alt="img-flag" class="img-fluid mr-2">Italian</a>
                                                <a class="iq-sub-card" href="#"><img
                                                        src="{{ asset('public/assets/images/small/flag-05.png') }}"
                                                        alt="img-flag" class="img-fluid mr-2">German</a>
                                                <a class="iq-sub-card" href="#"><img
                                                        src="{{ asset('public/assets/images/small/flag-06.png') }}"
                                                        alt="img-flag" class="img-fluid mr-2">Japanese</a>
                                            </div>
                                        </div>
                                    </div>
                                </li> --}}
                                {{-- <li>
                                    <a href="#" class="btn border add-btn shadow-none mx-2 d-none d-md-block"
                                        data-toggle="modal" data-target="#new-order"><i class="las la-plus mr-2"></i>New
                                        Order</a>
                                </li> --}}
                                {{-- <li class="nav-item nav-icon dropdown">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-bell">
                                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                        </svg>
                                        <span class="bg-primary "></span>
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 ">
                                                <div class="cust-title p-3">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <h5 class="mb-0">Notifications</h5>
                                                        <a class="badge badge-primary badge-card" href="#">3</a>
                                                    </div>
                                                </div>
                                                <div class="px-3 pt-0 pb-0 sub-card">
                                                    <a href="#" class="iq-sub-card">
                                                        <div
                                                            class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="{{ asset('public/assets/images/user/01.jpg') }}"
                                                                    alt="01">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Emma Watson</h6>
                                                                    <small class="text-dark"><b>12 : 47 pm</b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit
                                                                    amet</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div
                                                            class="media align-items-center cust-card py-3 border-bottom">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="{{ asset('public/assets/images/user/02.jpg') }}"
                                                                    alt="02">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Ashlynn Franci</h6>
                                                                    <small class="text-dark"><b>11 : 30 pm</b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit
                                                                    amet</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="iq-sub-card">
                                                        <div class="media align-items-center cust-card py-3">
                                                            <div class="">
                                                                <img class="avatar-50 rounded-small"
                                                                    src="{{ asset('public/assets/images/user/03.jpg') }}"
                                                                    alt="03">
                                                            </div>
                                                            <div class="media-body ml-3">
                                                                <div
                                                                    class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0">Kianna Carder</h6>
                                                                    <small class="text-dark"><b>11 : 21 pm</b></small>
                                                                </div>
                                                                <small class="mb-0">Lorem ipsum dolor sit
                                                                    amet</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                                <a class="right-ic btn btn-primary btn-block position-relative p-2"
                                                    href="#" role="button">
                                                    View All
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li> --}}
                                <li class="nav-item nav-icon dropdown caption-content">
                                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset(Auth::user()->profile_image ? asset('public/'.Auth::user()->profile_image) : 'public/assets/images/user/1.png') }}"
                                            class="img-fluid rounded" alt="user">
                                    </a>
                                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="card shadow-none m-0">
                                            <div class="card-body p-0 text-center">
                                                <div class="media-body profile-detail text-center">
                                                    <img src="{{ asset('public/assets/images/page-img/profile-bg.jpg') }}"
                                                        alt="profile-bg" class="rounded-top img-fluid mb-4">
                                                    <img src="{{ asset(Auth::user()->profile_image ? asset('public/'.Auth::user()->profile_image) : 'public/assets/images/user/1.png') }}"
                                                        alt="profile-img"
                                                        class="rounded profile-img img-fluid avatar-70">
                                                </div>
                                                <div class="p-3">
                                                    <h5 class="mb-1">{{ Auth::user()->name ?? '' }}</h5>
                                                    <p class="mb-0">Since {{ Auth::user()->created_at ? Auth::user()->created_at->format('d F, Y') : '' }}</p>
                                                    <div class="d-flex align-items-center justify-content-center mt-3">
                                                        <a href="{{ route('profile.edit') }}" class="btn border mr-2">Profile</a>
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn border">Sign Out</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup text-left">
                            <h4 class="mb-3">New Order</h4>
                            <div class="content create-workform bg-body">
                                <div class="pb-3">
                                    <label class="mb-2">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Name or Email">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                        <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete User Modal -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">Delete {{ $title ?? 'Data' }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form id="deleteUserForm" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
        {{-- </div> --}}

        @extends('components.footer')
