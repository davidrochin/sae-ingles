@extends('layouts.app')

@section('title', 'Bienvenido')

@section('section', 'Laratter')

@section('content')

<div class="row">
    @forelse($messages as $message)
        <div class="col-6">
            <img class="img-thumbnail" src="{{$message['image']}}">
            <p class="card-text">{{$message['content']}} - <a href="/messages/{{$message['id']}}">Leer más...</a></p>
            
        </div>
    @empty
        <p>No hay mensajes</p>
    @endforelse
</div>
@endsection