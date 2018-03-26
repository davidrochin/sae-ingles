    <table class="table table-hover text-nowrap">
        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Número de control</th>
                <th>Nombre(s)</th>
                <th>Apellido(s)</th>
                <th>Carrera</th>
                <th>Teléfono</th>
                <th>Correo electrónico</th>
                <th></th>
            </tr>
        </thead>

        <!--Imprimir un renglón dentro de la tabla para cada estudiante-->
        <tbody>
        @foreach($students as $student)
            <tr id="studentRow{{ $student->id }}" class="clickable-row">
                <!--<td><input type="checkbox" name="studentCheckbox{{ $student->id }}" onchange="selectStudent({{ $student->id }})"></td>-->
                <td>{{ $student->id }}</td>
                <td>{{ $student->control_number }}</td>
                <td>{{ $student->first_names }}</td>
                <td>{{ $student->last_names }}</td>
                <td>{{ $student->career->short_name }}</td>
                <td>{{ $student->phone_number }}</td>
                <td>{{ $student->email }}</td>
                <td><a href="{{ route('students') }}/{{ $student->id }}">Ver alumno</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>