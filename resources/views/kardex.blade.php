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
            <td>Carrera:
                <strong>{{ !is_null($student->career) ? $student->career->short_name : 'Carrera no registrada' }}
                </strong><strong></td>
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
            <td>TOEFL ID: {{$group->toefl_group_id}}@if($group->score>=$requiredcredits->points)
                (Acreditado)
                @endif

            </td> {{--falta los atributos del grupo TOEFL--}}
            <td>{{isset($group->score) ? $group->score : 'Sin resultados registrados aún'}}</td>

        </tr>

        @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay TOEFL aplicado.</td>
        </tr>
        @endforelse

        @forelse($student->groups as $group)
        <tr>
            <td>Curso Nivel {{$group->level}} ID: {{ $group->id}}</td>
            <!--<td>{{ isset($averages[$student->id]) ? $averages[$student->id] : 'Indefinido' }}</td>-->
            <td>{{ $group->getAverages()[$student->id] }}</td>
            {{--falta el promedio--}}
        </tr>

        @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay grupos cursados.</td>
        </tr>
        @endforelse
    </tbody>

</table>
@endsection