<table class="table table-hover table-bordered">

	@if(!isset($hideHead))
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Resultado</th>
			<th>Meta</th>
			<th>Acreditado</th>
			<th></th>
		</tr>
	</thead>
	@endif

	<tbody>

 @forelse($groupstoefl as $key => $group)
            <tr>
                <td>TOEFL ID: {{$group->toefl_group_id}}</td> {{--falta los atributos del grupo TOEFL--}}
                 <td>{{isset($group->score) ? $group->score : 'Sin resultados registrados aún'}}</td>
                 <td>{{$requiredcredits->points}}</td>
                 <td>@if($group->score>=$requiredcredits->points) 
                     <a href="{{ route('toefl-accreditation', $student->id) }} " target="_blank">Carta de liberación</a>
                    @else
                     No se acreditó
                     @endif
                 </td>

                 <td><a href="{{ route('toefl') }}/{{ $group->toefl_group_id }}">Ver más</a></td>
            </tr>
           
            @empty
        <tr>
            <td colspan="99" class="text-center text-muted">No hay TOEFL aplicado.</td>
        </tr>
     @endforelse
	</tbody>

</table>