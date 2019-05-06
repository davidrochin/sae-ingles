@extends('layouts.app', ['background' => 'gray'])
@section('title', 'Usuario')
@section('section', 'Información del usuario')

@section('content')

<div class="row">

    <div class="col-12 col-xl-6">

        <!-- Tarjeta de información básica -->
        @component('components.card')
            @slot('header', 'Información del usuario')

            <form class="form" action="/usuario/modificar" method="post" name="editUserForm">

                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col-2">
                             @component('components.form-input')
                                @slot('tag', 'ID')
                                @slot('name', 'iduser')
                                @slot('disabled', 'true')
                                @slot('class', 'bg-white')
                                @slot('value', $user->id)
                            @endcomponent
                        </div>
                        <div class="col">
                            @component('components.form-input')
                                @slot('tag', 'Nombre')
                                @slot('name', 'name')
                                @slot('disabled', 'true')
                                @slot('class', 'bg-white')
                                @slot('value', $user->name)
                            @endcomponent
                        </div>
                    </div> 

                    <div class="form-row">
                        <div class="col">
                        <div class="form-group">
                            <label for="roleControlInput">Rol</label>
                            <select class="form-control bg-white" id="roleControlInput" name="role" disabled>
                                @foreach(App\Role::all() as $role)
                                <option value="{{$role->id}}" {{ $user->role->id == $role->id ? 'selected' : '' }}>{{ $role->description }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="col">
                            @component('components.form-input')
                                @slot('tag', 'Correo electrónico')
                                @slot('name', 'email')
                                @slot('disabled', 'true')
                                @slot('class', 'bg-white')
                                @slot('value', $user->email)
                            @endcomponent
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary float-right" id="sendFormButton" value="Aplicar cambios" hidden>
                </form>
        @endcomponent

        <!-- Tarjeta de acciones -->
        @if(Auth::user()->hasAnyRole('admin', 'coordinator'))
            @component('components.card')
                @slot('header', 'Acciones')
                @slot('class', 'mt-3')

                <div class="form-row">
                    <div class="col-auto">
                        <form action="/usuario/eliminar" method="post" name="deleteUserForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <!--<button type="submit" class="btn btn-danger">Eliminar alumno</button>-->
                            <button type="submit" class="btn btn-danger" data-toggle="confirmation">Eliminar usuario</button>
                        </form>
                    </div>
                    
                    <div class="col-auto">
                        <button id="editUserButton" class="btn btn-secondary" onclick="formEditMode('editUserForm'); deleteById('editUserButton')">Modificar datos</button>
                    </div> 
                </div>
            @endcomponent
        @endif

    </div>

</div>





@endsection

@section('scripts')

<script type="text/javascript">
    
    //Activa todos los elementos de la Form
    function formEditMode(formName){

        //Activar los elementos de la Form
        var formElements = document.forms[formName].elements;
        for(var i = 0; i < formElements.length; i++){
            if(formElements[i].name != 'iduser'){
                formElements[i].readOnly = false;
                formElements[i].disabled = false;
            }
        }

        //Aparecer el botón de enviar
        document.getElementById('sendFormButton').hidden = false;
    }

    //Elimina un elemento por su id
    function deleteById(id){
        var element = document.getElementById(id);
        element.outerHTML = '';
        delete element;
    }

    @if($errors->any())
    alert('{{ $errors->all()[0] }}');
    @endif

</script>

@endsection