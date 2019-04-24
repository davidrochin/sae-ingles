@extends('layouts.app')
@section('title', 'Kardex')
@section('section', 'Kardex')

@section('content')

		@slot('body')

	 <table class="table table-hover text-left">

      
        <tbody>
      
            <tr>
                <td>Alumno: <strong>{{$student->last_names}} {{ $student->first_names }}</strong></td>
                <td>No. Control: <strong>{{$student->control_number}}</strong></td>
               
            </tr>
            <tr>
                <td>Carrera: <strong>{{ !is_null($student->career) ? $student->career->short_name : 'Carrera no registrada' }} </strong><strong></td>
                <td>Fecha: <strong> {{$date}}</strong></td>
               
            </tr>
     
        </tbody>

    </table>	

  <table class="table table-hover text-left">

        <thead class="thead-light">
         
            <tr>
                <!--<th></th>-->
                PRUEBA VISUAL DE LA TABLA
                <th>Curso</th>
                <th>Calificación</th>
            </tr>
        </thead>

        <tbody> 
     @forelse($groupstoefl as $key => $group)
            <tr>
                <td> <a href="{{ route('toefl-accreditation') }}" }}">TOEFL {{ $group }}</a></td>
                < <td> <a href="{{ route('toefl-accreditation') }}" }}">8854 {{ $group }}</a></td>
               
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay grupos cursados.</td>
        </tr>
     @endforelse
        </tbody>

    </table>
@endsection
