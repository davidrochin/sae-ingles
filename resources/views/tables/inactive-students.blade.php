    <table class="table table-hover">
        <thead class="thead-light">
            <tr> 
                <!--<th></th>-->
                <th>ID</th>
                <th>No. control</th>
                <th>Apellido(s)</th>
                <th>Nombre(s)</th>
                <th>Carrera</th>
                <th>Acreditado</th>
                <th></th>
            </tr>
        </thead>

        <!--Imprimir un renglón dentro de la tabla para cada estudiante-->
        <tbody>
        @foreach($students as $student)
            <tr id="studentRow{{ $student->id }}" class="clickable-row">
                <td>{{ $student->id }}</td>
                <td>{{ $student->control_number }}</td>
                <td>{{ $student->last_names }}</td>
                <td>{{ $student->first_names }}</td>
                <td>{{ !is_null($student->career) ? $student->career->short_name : '' }}</td>

        <!--faltaria una columna que mencione el curso anterior o primera vez -->
                <td><span class="badge badge-pill badge-{{ $student->isActive() ? 'primary' : 'secondary' }}">{{ $student->isActive() ? 'Acreditado' : 'Reprobado' }}</span></td>
                <td><a href="{{ route('students') }}/{{ $student->id }}">Ver alumno</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>