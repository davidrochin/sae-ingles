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
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($groups as $group)
            <tr id="tableRow{{ $group->id }}" class="clickable-row">
                <td>{{ $group->id }}</td>
                <td>{{ Carbon\Carbon::parse($group->schedule_start)->format('H:i') }} - {{ Carbon\Carbon::parse($group->schedule_end)->format('H:i') }}</td>
                <td>{{ $group->classroom->name }}</td>
                <td>{{-- $group->days --}}
                    @component('components.days-badges')
                        @slot('days', $group->days)
                    @endcomponent
                </td>
                <td>{{ $group->code }}</td>
                <td>{{ $group->name }}</td>
                <td>{{ $group->level }}</td>
                <td><a href="{{ route('groups') }}/{{ $group->id }}">Ver grupo</a></td>
            </tr>
        @endforeach
        </tbody>

    </table>