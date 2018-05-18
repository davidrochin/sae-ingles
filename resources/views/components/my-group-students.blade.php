<table class="table table-hover table-bordered">
	<thead class=>
		<tr>
			<th>No.</th>
			<th>Nombre</th>
			<th>No. control</th>
			@for($i = 0; $i < ((int)App\Setting::where('name', 'partial_count')->first()->value); $i++)
			<th>{{ "Parcial ".($i + 1) }}</th>
			@endfor
			<th>Promedio</th>
		</tr>
	</thead>

	<tbody>
			@forelse($group->students as $key => $student)
				<tr>	
					<td>{{ $key + 1 }}</td>
					<td>{{ $student->last_names }} {{ $student->first_names }}</td>
					<td>{{ $student->control_number or 'Alumno externo' }}</td>
					@for($i = 0; $i < ((int)App\Setting::where('name', 'partial_count')->first()->value); $i++)
						<td>
							<input type="hidden" name="studentIds[]" value="{{ $student->id }}">
							<input type="number" name="scores[]" min="0" max="100" value="{{ $gradesTable[$student->id][$i + 1] }}">
							<input type="hidden" name="partials[]" value="{{ $i + 1 }}">
						</td>
					@endfor
					<td>{{ $averages[$student->id] }}</td>
				</tr>
			@empty
				<tr>
					<td colspan="99" class="text-center text-muted">No hay alumnos asignados a este grupo.</td>
				</tr>
			@endforelse
		
	</tbody>
</table>