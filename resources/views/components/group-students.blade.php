<table class="table table-hover table-bordered">

	<thead class=>
		<tr>
			<th>No.</th>
			<th>Nombre</th>
			<th>No. control</th>
			<th>Acciones</th>
		</tr>
	</thead>

	<tbody>
		@forelse($group->students as $key => $student)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td><a href="{{ route('students') }}/{{ $student->id }}">{{ $student->last_names }} {{ $student->first_names }}</a></td>
			<td>{{ $student->control_number or 'Alumno externo' }}</td>
			<form action="/grupos/remover" method="post" id="removeForm{{ $student->id }}">
				{{ csrf_field() }}
				<input type="hidden" name="studentId" value="{{ $student->id }}"><input type="hidden" name="groupId" value="{{ $group->id }}">
				<td><a class="badge badge-danger" href="javascript:;" onclick=" document.getElementById('removeForm{{ $student->id }}').submit();">Remover</a></td>
			</form>
		</tr>
		@empty
		<tr>
			<td colspan="99" class="text-center text-muted">No hay alumnos asignados a este grupo.</td>
		</tr>
		@endforelse
	</tbody>

</table>