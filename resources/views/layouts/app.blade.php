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
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script
            src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"
            integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0="
            crossorigin="anonymous"></script>

</head>
<body>
@include('includes.header')
    <div id="app">
         @yield('content')
    </div>
@include('includes.footer')
<div class="modal-wrap modal-balance modal-balance--one">
    <div class="modal modal-balance-size">
        <div class="modal__body">
            <div class="modal__close"></div>
            <div class="modal-balance__title">
                Поповнення балансу
            </div>
            <div class="modal-balance__subtitle">
                Коротка інформація як користувач сайту може використати придбані монети
            </div>
            <div class="now-available">
                Зараз в наявності:
                <div class="now-available__wrap">
                    <img src="img/coins-orange.svg" alt="img">
                    12 монет
                </div>
            </div>
            <button class="modal-balance__btn btn btn--purple trigger-next1">
                Поповнити баланс
            </button>
        </div>
    </div>
</div>
</body>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
</html>