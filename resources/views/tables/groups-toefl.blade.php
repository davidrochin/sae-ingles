    <table class="table table-hover">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Responsable</th>
                <th>Aplicador</th>
                <th>Fecha</th>
                <th>Aula</th>
                <th>Aplicado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($groups as $group)
            <tr id="tableRow{{ $group->id }}" class="clickable-row">
                <td>{{ $group->id }}</td>
                <td>{{ !is_null($group->responsableUser) ? $group->responsableUser->name : '' }}</td>
                <td>{{ !is_null($group->applicatorUser) ? $group->applicatorUser->name : '' }}</td>
                <td>{{ $group->date }}</td>
                <td>{{ !is_null($group->classroom) ? $group->classroom->name : ''}}</td>
                <td>  @component('components.toefl-state-badge')
                        @slot('group', $group)
                    @endcomponent</td>
                 <td><a href="{{ route('toefl') }}/{{ $group->id }}">Ver grupo</a></td>
               
                
            </tr>
        @endforeach
        </tbody>

    </table>