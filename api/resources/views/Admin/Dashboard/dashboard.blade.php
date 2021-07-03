@extends('Admin::layouts.layout')

@section('header')
    @include('Admin::layouts.parts.header')
@endsection

@section('navigation')
    {!! $sidebar !!}
@endsection

@section('content')
    {!! $content !!}
@endsection

@section('footer')
    @include('Admin::layouts.parts.footer')
@endsection