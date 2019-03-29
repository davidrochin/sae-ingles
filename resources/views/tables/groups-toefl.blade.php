    <table class="table table-hover">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Responsable</th>
                <th>Aplicador</th>
                <th>Fecha</th>
                <th>Aplicado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($groups as $group)
            <tr id="tableRow{{ $group->id }}" class="clickable-row">
                <td>{{ $group->id }}</td>
                <td>{{ !is_null($group->responsableUser) ? $group->responsableUser->name : '' }}</td>
                <td>{{ !is_null($group->responsableUser) ? $group->responsableUser->name : '' }}</td>
                <td>{{ $group->date }}</td>
                <td>{{ $group->applied }}</td>
               
               
            </tr>
        @endforeach
        </tbody>

    </table>