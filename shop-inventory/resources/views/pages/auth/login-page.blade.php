@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
@endsection

<main>
    @include('components.auth.login-form')
</main>
