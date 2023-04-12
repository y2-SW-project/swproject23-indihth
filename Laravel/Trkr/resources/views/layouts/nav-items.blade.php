<ul class="navbar-nav me-auto flex-column">
    {{-- <li class="nav-item">
        <a class="nav-link" :href="route('goals.index')"
            :active="request() - > routeIs('goals.index')">{{ __('Goals') }}</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.dashboard') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.indexGoals') }}">{{ __('Goals') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.indexUsers') }}">{{ __('Users') }}</a>
    </li>

    {{-- Only display Profile nav item to Users who are logged in, not Admin --}}
    @if (auth()->check())
        @if (!auth()->user()->isAdministrator())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home.profile') }}">{{ __('Profile') }}</a>
            </li>
        @endif
    @endif
</ul>
