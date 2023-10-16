@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/send-otp/send-otp.css') }}">
@endsection

<main>
    @include('components.auth.send-otp-form')
</main>
