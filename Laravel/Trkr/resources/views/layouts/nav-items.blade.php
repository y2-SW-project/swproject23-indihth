{{-- Make style rule for width? --}}
<div class="col-auto col-lg-2 col-xl-2 px-lg-2 px-0 ">

    {{-- Responsive side nav bar, text hides at medium breakpoint --}}
    <nav class="d-flex flex-column sticky-top align-items-center align-items-lg-start px-3 min-vh-100">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a href="{{ route('home.dashboard') }}"
                class="d-flex align-items-center pb-3 pt-2 mb-lg-0 me-lg-auto text-decoration-none text-dark">
                <span class="fs-2 d-none d-lg-inline">Sidebar</span>
            </a>
            {{-- <a href="{{ URL::previous() }}">
                <i class="bi bi-arrow-left text-dark fs-4"></i>
            </a> --}}
        </div>
        <ul class="nav nav-pills flex-column mb-lg-auto mb-0 align-items-center align-items-lg-start fw-bolder">

            {{-- Active class not working yet --}}
            <li class="nav-item {{ Request::is('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('home.dashboard') }}" class="nav-link  px-0 align-middle" aria-current="page">
                    <i class="bi-speedometer2"></i> <span class="ms-2 d-none d-lg-inline">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('home.indexGoals') ? 'active' : '' }}">
                <a href="{{ route('home.indexGoals') }}" class="nav-link  px-0 align-middle" aria-current="page">
                    <i class="bi bi-bullseye"></i> <span class="ms-2 d-none d-lg-inline">{{ __('Goal') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('home.indexUsers') ? 'active' : '' }}">
                <a href="{{ route('home.indexUsers') }}" class="nav-link  px-0 align-middle" aria-current="page">
                    <i class="bi bi-people-fill"></i> <span class="ms-2 d-none d-lg-inline">{{ __('Partners') }}</span>
                </a>
            </li>

        </ul>

        <hr />

        {{-- Login / Register --}}
        @guest
            <ul class="nav nav-pills flex-column">
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
            </ul>

            {{-- User logout --}}
            <div class="dropdown pb-3">
                <a href="#"
                    class="d-flex align-items-center text-dark link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/images/users/' . Auth::user()->user_image) }}" alt="" width="32"
                        height="32" class="rounded-circle me-2">
                    <span class="d-none d-lg-inline mx-1">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu text-small shadow">
                    @if (auth()->check())
                        @if (!auth()->user()->isAdministrator())
                            <li class="nav-item">
                                <a href="{{ route('home.profile') }}" class="dropdown-item" aria-current="page">
                                    {{ __('Profile') }}
                                </a>
                            </li>
                        @endif
                    @endif
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul>
            </div>
        @endguest
    </nav>
</div>
