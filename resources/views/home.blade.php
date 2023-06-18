@extends('layouts.main')

@section('container')
    @include('partials.sidebar')
    <h1> Welcome Back, {{ $user->name }}</h1>


    @include('partials.script')
@endsection
