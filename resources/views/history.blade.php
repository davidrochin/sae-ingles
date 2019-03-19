@extends('layouts.app')
@section('title', 'Historial')
@section('section', 'Historial')

@section('content')

<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>Fecha y hora</th>
            <th>Usuario</th>
            <th>Descripción</th>
        </tr>
    </thead>

    <tbody>
        @foreach($history as $h)
        <tr id="historyRow{{ $h->id }}" class="clickable-row">
            <td>{{ $h->created_at }}</td>
            <td>{{ $h->user->name }}</td>
            <td>{{ $h->description }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection