@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/signup/signup.css') }}">
@endsection

<main>
    @include('components.auth.signup-form')
</main>
