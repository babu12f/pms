<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <title>NRB Project Management App By [ Babor ]</title>
    <meta name="description" content="NRB PNS is a project management app built for learning purposes">

    <!-- Typekit Fonts -->
    <script src="//use.typekit.net/udt8boc.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>

    <!-- Library Css File -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/jquery.atwho.min.css') }}">

    <!-- Custom Css File -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
    <script src="{{ asset('js/jquery.atwho.js') }}"></script>
    <script src="{{ asset('js/jquery.caret.js') }}"></script>
    <script src="{{ asset('js/laravel.mentions.js') }}"></script>
    {{--@include('mentions::assets')--}}
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            @yield('content')
        </div>
    </div>
</body>
</html>