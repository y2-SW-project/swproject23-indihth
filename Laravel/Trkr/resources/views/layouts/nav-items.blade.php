<ul class="navbar-nav me-auto">
    {{-- <li class="nav-item">
        <a class="nav-link" :href="route('goals.index')"
            :active="request() - > routeIs('goals.index')">{{ __('Goals') }}</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.index') }}">{{ __('Home') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home.indexUsers') }}">{{ __('Users') }}</a>
    </li>
    
</ul>
