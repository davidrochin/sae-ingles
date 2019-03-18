    <table class="table table-hover text-left">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Nombre</th>
                <th>Nombre corto</th>
            </tr>
        </thead>

        <tbody>
        @foreach($careers as $career)
            <tr id="tableRow{{ $career->id }}" class="clickable-row">
                <td>{{ $career->id }}</td>
                <td>{{ $career->name }}</td>
                <td>{{ $career->short_name }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>