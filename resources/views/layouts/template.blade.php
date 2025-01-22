<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{asset("img/icons/icon-48x48.png")}}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <title>@yield("title") - система оценки питание</title>
    <link href="{{asset("dist/css/tabler.min.css")}}" rel="stylesheet"/>
    <link href="{{asset("dist/css/tabler-flags.min.css")}}" rel="stylesheet"/>
    <link href="{{asset("dist/css/tabler-payments.min.css")}}" rel="stylesheet"/>
    <link href="{{asset("dist/css/tabler-vendors.min.css")}}" rel="stylesheet"/>
    <link href="{{asset("dist/css/demo.min.css")}}" rel="stylesheet"/>


    <link href="{{asset("css/app.css")}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
<script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
<script src="{{ asset('dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>

<script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>



@yield("body")
</body>
</html>
