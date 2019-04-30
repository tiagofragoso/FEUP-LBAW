@extends('layouts.app')

@section('title', '404 - Not Found')

@section('content')
	@include('partials.error', ['error' => '404 - Not Found', 'message' => 'The resource you are trying to access does not exist.'])
@endsection