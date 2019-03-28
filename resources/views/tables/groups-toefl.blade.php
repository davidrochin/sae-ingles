    <table class="table table-hover">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Responsable</th>
                <th>Aplicador</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($groups as $group)
            <tr id="tableRow{{ $group->id }}" class="clickable-row">
                <td>{{ $group->id }}</td>
                <td>{{ $group->responsable_user_id }}</td>
                <td>{{ $group->applicator_user_id }}</td>
                <td>{{ $group->date }}</td>
               
               
            </tr>
        @endforeach
        </tbody>

    </table>