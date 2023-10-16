@extends('layout.app')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/reset-pass/reset-pass.css') }}">
@endsection

<main>
    @include('components.auth.reset-pass-form')
</main>
