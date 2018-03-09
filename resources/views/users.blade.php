@extends('layouts.app')
@section('title', 'Usuarios del sistema')
@section('section', 'Usuarios del sistema')

@section('content')
	@include('tables.users')
@endsection