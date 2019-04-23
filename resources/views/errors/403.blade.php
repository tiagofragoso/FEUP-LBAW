@extends('layouts.app')

@section('title', '403 - Unauthorized')

@section('content')
	@include('partials.error', ['error' => '403 - Unauthorized', 'message' => 'You should\'t be here.'])
@endsection