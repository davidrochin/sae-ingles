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
     @forelse($student->toefls as $key => $group)
            <tr>
                <td> <a href="{{ route('toefl-accreditation') }}">TOEFL No.{{$group->id}}:  {{$group->date}}</a></td> {{--estoy obteniendo el id de la tabla STUDENTS_TOEFL_GROUP.  falta relacionarla con la TOEFLGROUP para obtener el ID y DATE del grupo--}}
                 <td> falta obtener el score</td>
               
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay TOEFL aplicado.</td>
        </tr>
     @endforelse

      @forelse($student->groups as $group)
            <tr>
                <td>Nivel {{$group->level}}: {{ $group->code}} </td> {{--estoy obteniendo el id de la tabla STUDENTS_TOEFL_GROUP.  falta relacionarla con la TOEFLGROUP para obtener el ID y DATE del grupo--}}
                 <td> falta obtener promedio</td>
               
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay TOEFL aplicado.</td>
        </tr>
     @endforelse

    
        </tbody>

    </table>
@endsection
