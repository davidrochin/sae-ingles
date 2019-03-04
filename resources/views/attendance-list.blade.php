@extends('layouts.blank')
@section('title', 'Lista de asistencia')
@section('content')

<div class="row mb-5 mt-2 text-center">
	<div class="col">
		<h4>Formato oficial de listas de asistencia</h4>
		<h4>Departamento de Gestión Tecnológica y Vinculación</h4>
		<h4>Programa CLE-ITLM</h4>
	</div>
</div>

<table class="table table-bordered text-nowrap table-attendance">
	<tbody>
		<td>Nivel <b>{{ $group->level }}</b></td>
		<td>Horario <b>@component('components.days-badges')
                        @slot('days', $group->days)
                    @endcomponent {{ Carbon\Carbon::parse($group->schedule_start)->format('H:i') }} - {{ Carbon\Carbon::parse($group->schedule_end)->format('H:i')}}</b></td> 
		<td>Profesor <b>{{ $group->user->name }}</b></td>
		<td>{{ $group->classroom->name }}</b></td>
		<td>Periodo <b>{{ $group->period->name }}</b></td>
		<td>Año <b>{{ $group->year }}</b></td>

	
	</tbody>
</table>

<table class="table table-bordered table-attendance text-nowrap">
	<thead>
		<th>No.</th>
		<th>Nombre completo</th>
		<th>No. control</th>
		<th>Carrera</th>
		<th colspan="999">Asistencia</th>
	</thead>
	<tbody>
		@foreach($students as $key => $student)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td>{{ $student->last_names}} {{ $student->first_names }}</td>
				<td>{{ $student->control_number }}</td>
				<td>{{ !is_null($student->career) ? $student->career->short_name : 'Carrera no registrada' }}</td>
				@for($i = 0 ; $i < $attendanceSlots ; $i++)
					<th></th>
				@endfor
			</tr>
		@endforeach
	</tbody>
</table>

@endsection

@section('scripts')

<script type="text/javascript">

	//Abrir el documento en modo de impresión
	$(document).ready( function(){
		window.print();
	});
</script>

<style type="text/css">
	.table-attendance th {
		font-size: 1.2rem;
	}
	.table-attendance td {
		padding-bottom: 0.3rem;
		padding-top: 0.3rem;
		font-size: 1.2rem;
	}
</style>

@endsection