@extends('layouts.app')
@section('title', 'Usuarios del sistema')
@section('section', 'Usuarios del sistema')

@section('content')
	@include('tables.users')

<div class="row">
    <div class="mx-auto">
        {{ $users->appends($_GET)->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection