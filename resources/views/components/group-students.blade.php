<table class="table table-hover">

	<thead class="thead-light">
		<tr>
			<th>Alumno</th>
		</tr>
	</thead>

	<tbody>
		@forelse($group->students as $student)
		<tr>
			<td><a href="{{ route('students') }}/{{ $student->id }}">{{ $student->last_names }} {{ $student->first_names }}</a></td>
		</tr>
		@empty
		@endforelse
	</tbody>

</table>