<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peminjaman</title>

    {{--  OWN CSS  --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{--  BOOTSTRAP  --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    {{--  FOTAWESOME  --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
</head>
<body>
    @include('layouts.alert')
    @yield('mainLayouts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>
