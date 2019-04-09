<table class="table table-hover table-bordered">

	<thead class=>
		<tr>
			<th>No.</th>
			<th>Nombre</th>
			<th>No. control</th>
			<th>Resultado</th>
			@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
				<th>Acciones</th>
			@endif
		</tr>
	</thead>

	<tbody>
		
		<tr>
			<td>1</td>
			<td>oswa gue san</td>
			<td>14440600</td>
			<td>856</td>
			
		</tr>
		
		<tr>
			<td colspan="99" class="text-center text-muted">No hay alumnos asignados a este grupo.</td>
		</tr>
		
	</tbody>

</table>