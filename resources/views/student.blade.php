@extends('layouts.app', ['background' => 'gray'])
@section('title', 'Alumno')
@section('section', 'Información del alumno')

@section('content')

<div class="row">

    <div class="col-xl">

        <!-- Tarjeta de información básica -->
        @component('components.card')
            @slot('header', 'Información del alumno')

            <form class="form" action="/alumnos/modificar" method="post" name="editStudentForm">

                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col">
                             <div class="form-group">
                                 <label for="idControlInput">ID</label>
                                 <input id="idControlInput" name="id" type="text" class="form-control  bg-white" value={{$student->id}} readonly="readonly">
                                 <div class="invalid-feedback"></div>
                             </div>
                        </div>
                        <div class="col">
                            @component('components.form-input')
                                @slot('tag', 'Número de control')
                                @slot('name', 'controlNumber')
                                @slot('disabled', 'true')
                                @slot('class', 'bg-white')
                                @slot('value', $student->control_number)
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col">
                            @component('components.form-input')
                                @slot('tag', 'Nombre(s)')
                                @slot('name', 'firstNames')
                                @slot('disabled', 'true')
                                @slot('class', 'bg-white')
                                @slot('value', $student->first_names)
                            @endcomponent
                        </div>
                        <div class="col">
                            @component('components.form-input')
                                @slot('tag', 'Apellidos')
                                @slot('name', 'lastNames')
                                @slot('disabled', 'true')
                                @slot('class', 'bg-white')
                                @slot('value', $student->last_names)
                            @endcomponent
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="careerId">Carrera</label>
                        <select name="careerId" class="form-control bg-white" disabled>
                            <option value="">Carrera no registrada</option>
                            @foreach($careers as $career)
                                <option {{ $student->career_id == $career->id ? 'selected' : '' }} value="{{ $career->id }}">{{ $career->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @component('components.form-input')
                        @slot('tag', 'Teléfono')
                        @slot('name', 'phoneNumber')
                        @slot('disabled', 'true')
                        @slot('class', 'bg-white')
                        @slot('value', $student->phone_number)
                    @endcomponent

                    @component('components.form-input')
                        @slot('tag', 'Correo electrónico')
                        @slot('name', 'email')
                        @slot('disabled', 'true')
                        @slot('class', 'bg-white')
                        @slot('value', $student->email)
                    @endcomponent

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
                        <form action="/alumnos/eliminar" method="post" name="deleteStudentForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            <!--<button type="submit" class="btn btn-danger">Eliminar alumno</button>-->
                            <button type="submit" class="btn btn-danger" data-toggle="confirmation">Eliminar alumno</button>
                        </form>
                    </div>
                    <div class="col-auto">
                        <button id="editStudentButton" class="btn btn-secondary" onclick="formEditMode('editStudentForm'); deleteById('editStudentButton')">Modificar datos</button>
                    </div>
                </div>
            @endcomponent
        @endif

    </div>

    <div class="col-7">
        
        @component('components.card')
            @slot('header', 'Grupos a los que pertenece el alumno')

            @component('components.student-groups')
                @slot('student', $student)
            @endcomponent

        @endcomponent

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
            if(formElements[i].name != 'id'){
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