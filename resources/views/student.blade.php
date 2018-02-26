@extends('layouts.app')
@section('title', 'Alumno '.$student->id)
@section('section', 'Información del alumno')

@section('content')

<!-- Tarjeta de información básica -->
<div class="card" style="width: 700px;">
    <div class="card-header">Información básica</div>
    <div class="card-body">
        <form class="form" action="/alumnos/modificar" method="post" name="editStudentForm">
            {{ csrf_field() }}
            <div class="form-row">
                <div class="form-group col">
                    <label for="id">ID</label>
                    <input type="text" name="id" class="form-control" value="{{ $student->id }}" readonly>
                </div>
                <div class="form-group col">
                    <label for="controlNumber">Número de control</label>
                    <input type="text" name="controlNumber" class="form-control" value="{{ $student->control_number }}" readonly>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col">
                    <label for="firstNames">Nombre(s)</label>
                    <input type="text" name="firstNames" class="form-control" value="{{ $student->first_names }}" readonly>
                </div>
                <div class="form-group col">
                    <label for="lastNames">Apellido(s)</label>
                    <input type="text" name="lastNames" class="form-control" value="{{ $student->last_names }}" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="careerId">Carrera</label>
                <select name="careerId" class="form-control" disabled>
                    @foreach($careers as $career)
                        <option {{ $student->career_id == $career->id ? 'selected' : '' }} value="{{ $career->id }}">{{ $career->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Teléfono</label>
                <input type="text" name="phoneNumber" class="form-control" value="{{ $student->phone_number }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" class="form-control" value="{{ $student->email }}" readonly>
            </div>
            <input type="submit" class="btn btn-primary float-right" id="sendFormButton" value="Aplicar cambios" hidden>
        </form>
    </div>
</div>

<!-- Tarjeta de acciones -->
<div class="card mt-3" style="width: 700px;">
    <div class="card-header">Acciones</div>
    <div class="card-body">
        <div class="form-row">
            <div class="col-auto">
                <form action="/alumnos/eliminar" method="post" name="deleteStudentForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $student->id }}">
                    <button type="submit" class="btn btn-danger">Eliminar alumno</button>
                </form>
                
            </div>
            <div class="col-auto">
                <button id="editStudentButton" class="btn btn-secondary" onclick="formEditMode('editStudentForm'); deleteById('editStudentButton')">Modificar datos</button>
            </div>
        </div>
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