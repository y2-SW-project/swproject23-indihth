<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css"> --}}

    {{-- Sweetalert2: Popup alerts on delte. Script and style sheet --}}
    <script src="
                                https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
                                "></script>


    <script src="sweetalert2.all.min.js"></script>
    <!-- Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        {{-- Not logged in, no nav --}}
        @if (Auth::guest())
            <main class="container-fluid">
                <div class="row m-0 flex-nowrap">
                    <div class="col-12 p-0">
                        @yield('content')
                    </div>
                @else
                    <main class="container-fluid">
                        <div class="row flex-nowrap">
                            {{-- If user is logged in, dislay navbar --}}
                            @include('layouts.nav-items')
                            <div class="col-9 py-3 pe-5">
                                @yield('content')
                            </div>
        @endif
    </div>
    </main>
    </div>
</body>

</html>
