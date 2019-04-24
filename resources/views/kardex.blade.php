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
                <th>Curso</th>
                <th>Calificación</th>
            </tr>
        </thead>

        <tbody> 
     @forelse($groupstoefl as $key => $group)
            <tr>
                <td> <a href="{{ route('toefl-accreditation') }}">TOEFL No. {{ $group->id}} </a></td> {{--estoy obteniendo el id de la tabla STUDENTS_TOEFL_GROUP.  falta relacionarla con la TOEFLGROUP para obtener el ID y DATE del grupo--}}
                 <td>{{ $group->score }}</td>
               
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay TOEFL aplicado.</td>
        </tr>
     @endforelse

     @forelse($groupsnormal as $key => $group->student)
            <tr>
                <td>Nivel 1: ID: {{ $group->id}} </td> {{--estoy obteniendo el id de la tabla STUDENTS_TOEFL_GROUP.  falta relacionarla con la TOEFLGROUP para obtener el ID y DATE del grupo--}}
                 <td>{{ $group->student->code }}</td>
               
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay grupos cursados.</td>
        </tr>
     @endforelse
        </tbody>

    </table>
@endsection
