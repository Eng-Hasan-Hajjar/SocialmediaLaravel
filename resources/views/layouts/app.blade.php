<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title > Impact Makers  </title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        #backgroundColorPicker {
            width: 100px;
            height: 40px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body class="font-sans antialiased" id="body"  style=" direction: rtl;text-align:right">
    <div class="min-h-screen">
        <!-- Page Content -->
        <main>
            @include('backend.home.dashboardinfo')
        </main>
        <div class="col-md-12">
            <div class="card">

            </div>
        </div>
    </div>
</body>
</html>
