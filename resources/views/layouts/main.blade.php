<!doctype html>
<html>

<head>
    <!-- META Tags -->
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> --}}
    <title>{{ isset($title) ? $title . ' | ' : null }}{{ config('app.name') }}</title>
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <meta name="author" content="{{ config('docsify.seo.author') }}">
    <meta name="description" content="{{ config('docsify.seo.description') }}">
    <meta name="keywords" content="{{ config('docsify.seo.keywords') }}">
    <meta name="twitter:card" value="summary">
    @if (isset($canonical) && $canonical)
        <link rel="canonical" href="{{ url($canonical) }}" />
    @endif
    @if ($openGraph = config('docsify.seo.og'))
        @foreach ($openGraph as $key => $value)
            @if ($value)
                <meta property="og:{{ $key }}" content="{{ $value }}" />
            @endif
        @endforeach
    @endif

    <!-- CSS -->
    <link rel="stylesheet" href="{{ assets('css/app.css') }}">

    @if (config('docsify.ui.fav'))
        <!-- Favicon -->
        <link rel="apple-touch-icon" href="{{ asset(config('docsify.ui.fav')) }}">
        <link rel="shortcut icon" type="image/png" href="{{ asset(config('docsify.ui.fav')) }}" />
    @endif

    <!-- FontAwesome -->
    <link rel="stylesheet" href="{{ docsify_assets('css/font-awesome.css') }}">
    @if (config('docsify.ui.fa_v4_shims', true))
        <link rel="stylesheet" href="{{ docsify_assets('css/font-awesome-v4-shims.css') }}">
    @endif

    <!-- Dynamic Colors -->
    @include('docsify::style')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @foreach (docsify::allStyles() as $name => $path)
        @if (preg_match('/^https?:\/\//', $path))
            <link rel="stylesheet" href="{{ $path }}">
        @else
            <link rel="stylesheet" href="{{ route('docsify.styles', $name) }}">
        @endif
    @endforeach --}}
</head>

<body>
    {{-- <div id="app" v-cloak> --}}
        @include('docsify::partials.navbar')

        {{-- @include('docsify::plugins.search')

        @yield('content')

        <docsify-back-to-top></docsify-back-to-top>
    </div>


    <script>
        window.config = @json([]);
    </script>

    <script type="text/javascript">
        if (localStorage.getItem('docsifySidebar') == null) {
            localStorage.setItem('docsifySidebar', !!{
                {
                    config('docsify.ui.show_side_bar') ? : 0
                }
            });
        }
    </script>

    <script src="{{ docsify_assets('js/app.js') }}"></script>

    <script>
        window.docsify = new Createdocsify(config)
    </script>

    @foreach (docsify::allScripts() as $name => $path)
        @if (preg_match('/^https?:\/\//', $path))
            <script src="{{ $path }}"></script>
        @else
            <script src="{{ route('docsify.scripts', $name) }}"></script>
        @endif
    @endforeach

    <script>
        docsify.run()
    </script> --}}
    <div>
        Start from page
        @yield('content')
    </div>
</body>

</html>
