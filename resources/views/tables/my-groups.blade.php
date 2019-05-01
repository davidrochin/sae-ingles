    <table class="table table-hover">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Horario</th>
                <th>Aula</th>
                <th>Dias</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @forelse($groups as $group)
            <tr id="tableRow{{ $group->id }}" class="clickable-row">
                <td>{{ $group->id }}</td>
                <td>{{ Carbon\Carbon::parse($group->schedule_start)->format('H:i') }} - {{ Carbon\Carbon::parse($group->schedule_end)->format('H:i') }}</td>
                <td>{{!is_null($group->classroom) ? $group->classroom->name : 'Sin aula asignada'}}</td>
                <td>{{-- $group->days --}}
                    @component('components.days-badges')
                        @slot('days', $group->days)
                    @endcomponent
                </td>
                <td>{{ $group->code }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->level }}</td>
                <td>   
                 @component('components.group-state-badge')
                 @slot('group', $group)
                 @endcomponent </td>


 
                   

                <td><a href="{{ route('my-groups') }}/{{ $group->id }}">Ver grupo</a></td>
            </tr>
        @empty
            <tr><td colspan="99" class="text-center text-muted">Usted no tiene ningun grupo asignado. Si piensa que esto es un error, por favor comuníqueselo a Coordinación.</td></tr>
        @endforelse
        </tbody>

    </table>