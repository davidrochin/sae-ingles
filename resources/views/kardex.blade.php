@extends('layouts.app')
@section('title', 'Kardex')
@section('section', 'Kardex')

@section('content')

		@slot('body')

<h5>Usuario ID: {{$student->id}}</h5>
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
                <td>TOEFL {{$group->toefl_group_id}}@if($group->score>=$requiredcredits->points) 
                     <a href="{{ route('toefl-accreditation') }}">Carta de liberación</a>
                        @endif

                 </td> {{--falta los atributos del grupo TOEFL--}}
                 <td>{{ $group->score }}</td>
               
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay TOEFL aplicado.</td>
        </tr>
     @endforelse

    @forelse($student->groups as $group)
            <tr>
                <td>Curso: ID: {{ $group->id}} </td> 
                 <td>{{isset($averages[$group->id]) ? $averages[$group->id] : 'Indefinido' }}</td>{{--falta el promedio--}}
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay grupos cursados.</td>
        </tr>
     @endforelse
        </tbody>

    </table>
@endsection
