<table class="table table-hover table-bordered">

	<thead class=>
		<tr>
			<th>No.</th>
			<th>Nombre</th>
			<th>No. control</th>
			@for($i = 0; $i < (int)App\Setting::where('name', 'partial_count')->first()->value; $i++)
				<th>Parcial {{ $i + 1 }}</th>
			@endfor
			<th>Promedio</th>
			@if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
				<th>Acciones</th>
			@endif
		</tr>
	</thead>


</table>