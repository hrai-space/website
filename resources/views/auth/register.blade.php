@extends('layouts.auth')
@section('title')Реєстрація@endsection

@section('css1')account.css @endsection
@section('css2')dashboard.css @endsection

@section('main_content')

@include('layouts.sign-up', ['class' => 'is-visible'])

@endsection