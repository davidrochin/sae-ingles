    <table class="table table-hover text-left">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Aula</th>

            </tr>
        </thead>

        <tbody>
        @foreach($classrooms as $classroom)
            <tr id="tableRow{{ $classroom->id }}" class="clickable-row">
                <td>{{ $classroom->id }}</td>
                <td>{{ $classroom->name }}</td>
               
            </tr>
        @endforeach
        </tbody>

    </table>