    <table class="table table-hover" id="usersTable">

        <thead class="thead-light">
            <tr>
                <!--<th></th>-->
                <th>ID</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Correo electrónico</th>
                @if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
                    <th>Contraseña</th>
                @endif
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

                @if(Auth::user()->hasAnyRole(['admin', 'coordinator']))
                    <td>
                        {{--@if($user->role->name == 'professor' || )--}}
                        @if(Auth::user()->isRoleSuperiorThan($user->role->name))
                            <a data-toggle="modal" href="#" data-target="#newPasswordUserModal" onclick="agregaDatos();">Nueva contraseña</a>
                        @endif
                    </td>
                @endif
                <td><a href="{{ route('users') }}/{{ $user->id }}">Ver usuario</a></td>

            </tr>
        @endforeach
        </tbody>

    </table>