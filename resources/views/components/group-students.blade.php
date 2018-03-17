<table class="table table-hover table-bordered">

	<thead class=>
		<tr>
			<th>No.</th>
			<th>Nombre</th>
			<th>No. control</th>
		</tr>
	</thead>

	<tbody>
		@forelse($group->students as $key => $student)
		<tr>
			<td>{{ $key + 1 }}</td>
			<td><a href="{{ route('students') }}/{{ $student->id }}">{{ $student->last_names }} {{ $student->first_names }}</a></td>
			<td>{{ $student->control_number or 'Alumno externo' }}</td>
		</tr>
		@empty
		@endforelse
	</tbody>

</table>