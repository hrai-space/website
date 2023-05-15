@extends('layouts.auth')
@section('title')Вхід@endsection

@section('css1')account.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

@include('layouts.sign-in', ['class' => 'e-visible'])


@endsection