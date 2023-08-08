<!DOCTYPE html>
<html lang="ru" class="page">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#111111">
    <title>NYC DOE Nurse Scheduler</title>
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @livewireStyles
</head>

<body class="page__body">
<div class="site-container">
    @include('partials.header')

    @yield('content')

    <footer class="footer">
        <div class="container"></div>
    </footer>
</div>

@livewireScripts
</body>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.3/axios.min.js"
    integrity="sha512-wS6VWtjvRcylhyoArkahZUkzZFeKB7ch/MHukprGSh1XIidNvHG1rxPhyFnL73M0FC1YXPIXLRDAoOyRJNni/g=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
></script>

<script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('js')

</html>
