@extends('layouts.app')
@section('title', 'TOEFL')
@section('section', 'TOEFL')

@section('content')

<div class="">

	<!--Botones para manipular tabla y buscador-->
	<div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">
    </div>

<div class="">
	@include('tables.groups-toefl')

	<div class="row">
	    <div class="mx-auto">
	        {{ $groups->appends($_GET)->links('pagination::bootstrap-4') }}
	    </div>
	</div>
</div>

@endsection
