<table class="table table-hover">

	@if(!isset($hideHead))
	<thead class="thead-light">
		<tr>
			<th>Nombre</th>
			<th>Horario</th>
			<th>Profesor</th>
			<th>Estado</th>
			<th></th>
		</tr>
	</thead>
	@endif

	<tbody>
		@forelse($student->groups as $group)
		<tr>
			<td>{{ $group->name }}</td>
			<td>{{ Carbon\Carbon::parse($group->schedule_start)->format('g:i A') }} - {{ Carbon\Carbon::parse($group->schedule_end)->format('g:i A') }}</td>
			<td>{{ $group->user->name }}</td>
			<td>
				@component('components.group-state-badge', ['group' => $group])
				@endcomponent
			</td>
			<td><a href="{{ route('groups') }}/{{ $group->id }}">Ver más</a></td>
		</tr>
		@empty
		@endforelse
	</tbody>

</table>