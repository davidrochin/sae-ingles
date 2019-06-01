@extends('layouts.blank')
@section('title', 'Lista de asistencia TOEFL')
@section('content')

<div class="row mb-5 mt-2 text-center">
	<div class="col">
		<h4>Formato de listas de asistencia de aplicación TOEFL</h4>
		<h4>Departamento de Gestión Tecnológica y Vinculación</h4>
		<h4>Programa CLE-ITLM</h4>
	</div>
</div>

<table class="table table-bordered text-nowrap table-attendance">
	<tbody>
		        <td>Grupo TOEFL ID: <b>{{ $group->id }}</b></td>
                <td>Responsable: <b>{{ !is_null($group->responsableUser) ? $group->responsableUser->name : 'Sin responsable'}}</b></td>
                <td>Aplicador: <b>{{!is_null($group->applicatorUser) ? $group->applicatorUser->name : 'Sin aplicador'}}</b></td>
                <td>Fecha: <b>{{ $group->date }}</b></td>
                <td>Hora: <b>{{ $group->time }}</b></td>
                <td>Aula: <b>{{ $group->classroom->name }}</b></td>
              
	
	</tbody>
</table>

<table class="table table-bordered table-attendance text-nowrap">
	<thead>
		<th>No.</th>
		<th>Nombre completo</th>
		<th>No. control</th>
		<th>Carrera</th>
		<th>Asistencia</th>
		<th>Resultado</th>
	</thead>
	<tbody>
		@foreach($students as $key => $student)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td>{{ $student->last_names}} {{ $student->first_names }}</td>
				<td>{{ $student->control_number }}</td>
				<td>{{ !is_null($student->career) ? $student->career->short_name : 'Carrera no registrada' }}</td>
				
					<th></th>
				<td>{{ isset($score[$student->id]) ? $score[$student->id] :  ""}}</td>
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
