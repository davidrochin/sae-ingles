<table class="table table-hover table-bordered">
	<thead class=>
		<tr>
			<th>No.</th>
			<th>Nombre</th>
			<th>No. control</th>
			@if($capture==true)
			@for($i = 0; $i < ((int)App\Setting::where('name', 'partial_count')->first()->value); $i++)
			<th>{{ "Parcial ".($i + 1) }}</th>
			@endfor
			
			<th>Promedio</th>
			@endif
		</tr>
	</thead>

	<tbody>
			@forelse($group->students as $key => $student)
				<tr>	
					<td>{{ $key + 1 }}</td>
					<td>{{ $student->last_names }} {{ $student->first_names }}</td>
					<td>{{ $student->control_number or 'Alumno externo' }}</td>
					@if($capture==true)
					@for($i = 1; $i <= ((int)App\Setting::where('name', 'partial_count')->first()->value); $i++)
						<td>
							<input type="number" name="grades[{{ $student->id }}][{{ $i }}]" min="0" max="100" value="{{ isset($gradesTable[$student->id][$i]) ? $gradesTable[$student->id][$i] : ""}}" class="form-control score-data">
						</td> 
					@endfor
					<td>{{ array_key_exists($student->id, $averages) ? $averages[$student->id] : 'Indefinido' }}</td>
				</tr>
				@endif
			@empty

				<tr>
					<td colspan="99" class="text-center text-muted">No hay alumnos asignados a este grupo.</td>
				</tr>
			@endforelse
		
	</tbody>
</table>