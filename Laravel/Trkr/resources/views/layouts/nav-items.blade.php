{{-- Make style rule for width? --}}
<div class="col-auto col-md-3 col-xl-2 px-md-2 px-0 ">

{{-- Responsive side nav bar, text hides at medium breakpoint --}}
    <nav class="d-flex flex-column align-items-center align-items-md-start px-3 pt-2 min-vh-100">
        {{-- <nav class="d-flex flex-column flex-shrink-0 navbar-dark bg-secondary rounded-5 "> --}}
        {{-- <hr> --}}
        <a href="{{ route('home.dashboard') }}"
            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-decoration-none">
            <span class="fs-5 d-none d-md-inline">Sidebar</span>
        </a>
        <ul class="nav nav-pills flex-column mb-md-auto mb-0 align-items-center align-items-md-start fw-bolder">
            <li class="nav-item {{ Request::is('user.dashboard') ? 'active' : '' }}">
                <a href="{{ route('home.dashboard') }}" class="nav-link  px-0 align-middle" aria-current="page">
                    <i class="fs-4 bi-speedometer2"></i> <span
                        class="ms-1 d-none d-md-inline">{{ __('Dashboard') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('user.goals.index') ? 'active' : '' }}">
                <a href="{{ route('user.goals.index') }}" class="nav-link  px-0 align-middle" aria-current="page">
                    <i class="bi bi-bullseye"></i> <span class="ms-1 d-none d-md-inline">{{ __('Goals') }}</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('home.indexUsers') ? 'active' : '' }}">
                <a href="{{ route('home.indexUsers') }}" class="nav-link  px-0 align-middle" aria-current="page">
                    <i class="bi bi-people-fill"></i> <span class="ms-1 d-none d-md-inline">{{ __('Users') }}</span>
                </a>
            </li>
            @if (auth()->check())
                @if (!auth()->user()->isAdministrator())
                    <li class="dropdown-item">
                        <a href="{{ route('home.dashboard') }}" class="nav-link  px-0 align-middle"
                            aria-current="page">
                            <i class="bi bi-people-fill"></i> <span
                                class="ms-1 d-none d-md-inline">{{ __('Profile') }}</span>
                        </a>
                    </li>
                @endif
            @endif
        </ul>

        <hr />

        {{-- Login / Register --}}
        @guest
            <ul class="nav nav-pills flex-column mb-auto">
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
            <div class="dropdown pb-3 ps-3">
                <a href="#"
                    class="d-flex align-items-center text-dark link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/images/' . Auth::user()->user_image) }}" alt="" width="32"
                        height="32" class="rounded-circle me-2">
                    <span class="d-none d-md-inline mx-1">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu text-mdall shadow">
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
