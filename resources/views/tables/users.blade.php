    <table class="table table-hover">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                <th>Contraseña</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
        @foreach($users as $user)
            <tr id="tableRow{{ $user->id }}" class="clickable-row">
                <td>{{ $user->id }}</td>
                <td>
                    @component('components.role-badge', ['role' => $user->role])
                    @endcomponent
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->role->name == 'professor')
                        <a href="#">Nueva contraseña</a>
                    @else
                        
                    @endif
                </td>
                <td><a href="{{ route('users') }}/{{ $user->id }}">Ver usuario</a></td>
            </tr>
        @endforeach
        </tbody>

    </table>