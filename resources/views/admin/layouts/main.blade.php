<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peminjaman</title>

    {{--  OWN CSS  --}}
    <link rel="stylesheet" href="{{ asset('css/admin/app.css') }}">

    {{--  BOOTSTRAP  --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


    {{--  FOTAWESOME  --}}
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">

    {{--  BOX ICONS  --}}
    <link rel="stylesheet" href="{{ asset('boxicons/css/boxicons.css') }}">
</head>
<body id="body-pd">
    @include('layouts.alert')
    @yield('mainAdminLayouts')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/admin/app.js') }}"></script>
</body>
</html>
