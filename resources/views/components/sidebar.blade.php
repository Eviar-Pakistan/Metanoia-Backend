<div class="iq-sidebar  sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('dashboard') }}" class="header-logo">
            {{-- <img src="{{ asset('public/assets/images/logo (2).png') }}" class="img-fluid rounded-normal light-logo"
                alt="logo"> --}}
            <h5 class="logo-title light-logo ml-3">PHYSIO-VR</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="svg-icon">
                        <svg class="svg-icon" id="p-dash1" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>

                {{-- <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <a href="#category" class="{{ request()->routeIs('category.*') ? '' : 'collapsed' }}"
                        data-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('category.*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2">
                            </rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Categories</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="category" class="iq-submenu collapse {{ request()->routeIs('category.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}">
                                <i class="las la-minus"></i><span>List Category</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('category.create') ? 'active' : '' }}">
                            <a href="{{ route('category.create') }}">
                                <i class="las la-minus"></i><span>Add Category</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="{{ request()->routeIs('product.*') ? 'active' : '' }}">
                    <a href="#product" class="{{ request()->routeIs('product.*') ? '' : 'collapsed' }}"
                        data-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('product.*') ? 'true' : 'false' }}">
                        <svg class="svg-icon" id="p-dash2" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                        <span class="ml-4">Products</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="product"
                        class="iq-submenu collapse {{ request()->routeIs('product.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('product.index') ? 'active' : '' }}">
                            <a href="{{ route('product.index') }}">
                                <i class="las la-minus"></i><span>List Product</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('product.create') ? 'active' : '' }}">
                            <a href="{{ route('product.create') }}">
                                <i class="las la-minus"></i><span>Add Product</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" ">
                    <a href="#sale" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash4" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                            <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                        </svg>
                        <span class="ml-4">Sale</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="sale" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="">
                            <a href="../backend/page-list-sale.html">
                                <i class="las la-minus"></i><span>List Sale</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="../backend/page-add-sale.html">
                                <i class="las la-minus"></i><span>Add Sale</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('purchase.*') ? 'active' : '' }}">
                    <a href="#purchase" class="{{ request()->routeIs('purchase.*') ? '' : 'collapsed' }}"
                        data-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('purchase.*') ? 'true' : 'false' }}">
                        <i class="bi bi-cart2" style="font-size: 21px;"></i>
                        <span class="ml-4">Purchase</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="purchase"
                        class="iq-submenu collapse {{ request()->routeIs('purchase.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('purchase.index') ? 'active' : '' }}">
                            <a href="{{ route('purchase.index') }}">
                                <i class="las la-minus"></i><span>List Purchase</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('purchase.create') ? 'active' : '' }}">
                            <a href="{{ route('purchase.create') }}">
                                <i class="las la-minus"></i><span>Add Purchase</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class=" ">
                    <a href="#return" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash6" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="4 14 10 14 10 20"></polyline>
                            <polyline points="20 10 14 10 14 4"></polyline>
                            <line x1="14" y1="10" x2="21" y2="3"></line>
                            <line x1="3" y1="21" x2="10" y2="14"></line>
                        </svg>
                        <span class="ml-4">Returns</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="return" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="">
                            <a href="../backend/page-list-returns.html">
                                <i class="las la-minus"></i><span>List Returns</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="../backend/page-add-return.html">
                                <i class="las la-minus"></i><span>Add Return</span>
                            </a>
                        </li>
                    </ul>
                </li>--}}

                <li
                    class=" {{ request()->routeIs('user.*')  ? 'active' : '' }}">
                    <a href="#people"
                        class="{{ request()->routeIs('user.*')  ? '' : 'collapsed' }}"
                        data-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('user.*')  ? 'true' : 'false' }}">
                        <i class="bi bi-people" style="font-size: 21px;"></i>
                        <span class="ml-4">Users</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="people"
                        class="iq-submenu collapse {{ request()->routeIs('user.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}">
                                <i class="las la-minus"></i><span>Users</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('user.create') ? 'active' : '' }}">
                            <a href="{{ route('user.create') }}">
                                <i class="las la-minus"></i><span>Add Users</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('devices.*') ? 'active' : '' }}">
                    <a href="#devices"
                       class="{{ request()->routeIs('devices.*') ? '' : 'collapsed' }}"
                       data-toggle="collapse"
                       aria-expanded="{{ request()->routeIs('devices.*') ? 'true' : 'false' }}">
                        <i class="bi bi-headset-vr" style="font-size: 21px;"></i>
                        <span class="ml-4">Devices</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="devices"
                        class="iq-submenu collapse {{ request()->routeIs('devices.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('devices.index') ? 'active' : '' }}">
                            <a href="{{ route('devices.index') }}">
                                <i class="las la-minus"></i><span>Devices List</span>
                            </a>
                        </li>
                        {{-- <li class="{{ request()->routeIs('devices.create') ? 'active' : '' }}">
                            <a href="{{ route('devices.create') }}">
                                <i class="las la-minus"></i><span>Add Device</span>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <a href="#category"
                       class="{{ request()->routeIs('category.*') ? '' : 'collapsed' }}"
                       data-toggle="collapse"
                       aria-expanded="{{ request()->routeIs('category.*') ? 'true' : 'false' }}">
                        <i class="las la-list" style="font-size: 21px;"></i>
                        <span class="ml-4">Category</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="category"
                        class="iq-submenu collapse {{ request()->routeIs('category.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('category.index') ? 'active' : '' }}">
                            <a href="{{ route('category.index') }}">
                                <i class="las la-minus"></i><span>Category List</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('category.create') ? 'active' : '' }}">
                            <a href="{{ route('category.create') }}">
                                <i class="las la-minus"></i><span>Add Category</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('subscription.*') ? 'active' : '' }}">
                    <a href="#subscription"
                       class="{{ request()->routeIs('subscription.*') ? '' : 'collapsed' }}"
                       data-toggle="collapse"
                       aria-expanded="{{ request()->routeIs('subscription.*') ? 'true' : 'false' }}">
                        <i class="las la-tag" style="font-size: 21px;"></i>
                        <span class="ml-4">Subscription</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="subscription"
                        class="iq-submenu collapse {{ request()->routeIs('subscription.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('subscription.index') ? 'active' : '' }}">
                            <a href="{{ route('subscription.index') }}">
                                <i class="las la-minus"></i><span>Subscription List</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('subscription.create') ? 'active' : '' }}">
                            <a href="{{ route('subscription.create') }}">
                                <i class="las la-minus"></i><span>Add Subscription</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">
                    <a href="#videos"
                       class="{{ request()->routeIs('videos.*') ? '' : 'collapsed' }}"
                       data-toggle="collapse"
                       aria-expanded="{{ request()->routeIs('videos.*') ? 'true' : 'false' }}">
                        <i class="las la-video" style="font-size: 21px;"></i>
                        <span class="ml-4">Videos</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="videos"
                        class="iq-submenu collapse {{ request()->routeIs('videos.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('videos.index') ? 'active' : '' }}">
                            <a href="{{ route('videos.index') }}">
                                <i class="las la-minus"></i><span>Video List</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('videos.create') ? 'active' : '' }}">
                            <a href="{{ route('videos.create') }}">
                                <i class="las la-minus"></i><span>Add Video</span>
                            </a>
                        </li>
                    </ul>
                </li>

               {{--  <li class="{{ request()->routeIs('branch.*') ? 'active' : '' }}">
                    <a href="#branch" class="{{ request()->routeIs('branch.*') ? '' : 'collapsed' }}"
                        data-toggle="collapse"
                        aria-expanded="{{ request()->routeIs('branch.*') ? 'true' : 'false' }}">
                        <i class="fas fa-code-branch" style="font-size: 21px;"></i>
                        <span class="ml-4">Branches</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="branch" class="iq-submenu collapse {{ request()->routeIs('branch.*') ? 'show' : '' }}"
                        data-parent="#iq-sidebar-toggle">
                        <li class="{{ request()->routeIs('branch.index') ? 'active' : '' }}">
                            <a href="{{ route('branch.index') }}">
                                <i class="las la-minus"></i><span>List Branch</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('branch.create') ? 'active' : '' }}">
                            <a href="{{ route('branch.create') }}">
                                <i class="las la-minus"></i><span>Add Branch</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a href="#" class="svg-icon" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-door-closed" style="font-size: 21px;"></i>
                            <span class="ml-4">Logout</span>
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</div>
