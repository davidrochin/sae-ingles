    <table class="table table-hover text-nowrap">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Profesor</th>
                <th>Horario</th>
                <th>Dias</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Año</th>
                <th>Periodo</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($groups as $group)
            <tr id="tableRow{{ $group->id }}" class="clickable-row">
                <td>{{ $group->id }}</td>
                <td>{{ $group->user->name }}</td>
                <td>{{ Carbon\Carbon::parse($group->schedule_start)->format('H:i') }} - {{ Carbon\Carbon::parse($group->schedule_end)->format('H:i') }}</td>
                <td>{{-- $group->days --}}
                    @component('components.days-badges')
                        @slot('days', $group->days)
                    @endcomponent
                </td>
                <td>{{ $group->code }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->level }}</td>
                <td>{{ $group->year }}</td>
                <td>{{ $group->period->short_name }}</td>
                <td>
                    @component('components.group-state-badge')
                        @slot('group', $group)
                    @endcomponent
                </td>
                <td><a href="{{ route('groups') }}/{{ $group->id }}">Ver grupo</a></td>
            </tr>
        @endforeach
        </tbody>

    </table>