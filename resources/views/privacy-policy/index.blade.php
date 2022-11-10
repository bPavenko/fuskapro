@extends('layouts.app')
@section('content')
@php
    $view = 'privacy-policy.' .  (Session::get('locale') ? Session::get('locale') : 'en');
@endphp
    @include($view)
@endsection