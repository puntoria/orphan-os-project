<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Orphan DB</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ url( elixir('css/app.css') ) }}" rel="stylesheet">
    <script type="text/javascript">
        var APP_URL = '{{ url() }}';
        var API_URL = APP_URL + "/api/v1";
        var TOKEN   = "{{ csrf_token() }}";
        var STORAGE = "{{ url('../storage/app') }}";

        var TRANSLATIONS = {
            months: {!! json_encode(trans('general.time.months')) !!},
            request: {!! json_encode(trans('general.js')) !!},
            stats: {!! json_encode(trans('general.stats')) !!}
        };
    </script>
    @yield('header-data')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="@yield('body-classes')">

    <div id="wrapper">
        <div id="@yield('app')">
            @yield('content')
        </div>
    </div>

    @yield('modals')

    @include('partials.dialog')
    
    @include('partials.gallery')

    @include('partials.email')

    @include('partials.loading')

    @include('partials.videoplayer')

    <script src="{{ url( elixir('js/app.js') ) }}" type="text/javascript"></script>
    @yield('footer-data')
</body>
</html>