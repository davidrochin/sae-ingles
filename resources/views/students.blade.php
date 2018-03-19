@extends('layouts.app')
@section('title', 'Alumnos')
@section('section', 'Alumnos')

@section('content')

<div class="">

    <!-- Modal para agregar un estudiante -->
    @component('components.modal')
        @slot('id', 'newStudentModal')
        @slot('title', 'Nuevo estudiante')
        @slot('dismiss', 'Cancelar')
        
        @slot('body')

            <!-- Formulario de nuevo alumno -->
            <form class="form" action="/alumnos/crear" method="post" id="createStudentForm">

                <!-- Crear el token de seguridad -->
                {{ csrf_field() }}

                <div class="form-row">
                    <div class="col">
                        @component('components.form-input')
                            @slot('tag', 'Número de control')
                            @slot('name', 'controlNumber')
                            @slot('value', old('controlNumber'))
                         @endcomponent
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="careerControlInput">Carrera</label>
                            <select class="form-control" id="careerControlInput" name="careerId">
                                <!-- Llenar el select con las carreras de la base de datos -->
                                @foreach($careers as $career)
                                <option value="{{$career->id}}" {{ old('careerId') == $career->id ? 'selected' : '' }}>{{ $career->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                @component('components.form-input')
                    @slot('tag', 'Nombre(s)')
                    @slot('name', 'firstNames')
                    @slot('value', old('firstNames'))
                @endcomponent

                @component('components.form-input')
                    @slot('tag', 'Apellidos')
                    @slot('name', 'lastNames')
                    @slot('value', old('lastNames'))
                @endcomponent

                <div class="form-row">
                    <div class="col">
                        @component('components.form-input')
                            @slot('tag', 'Teléfono')
                            @slot('name', 'phoneNumber')
                            @slot('type', 'tel')
                            @slot('value', old('phoneNumber'))
                        @endcomponent
                    </div>
                    <div class="col-7">
                        @component('components.form-input')
                            @slot('tag', 'Correo electrónico')
                            @slot('name', 'email')
                            @slot('type', 'email')
                            @slot('value', old('email'))
                        @endcomponent
                    </div>
                </div>
            </form>
        @endslot

        @slot('footer')
            <input type="submit" class="btn btn-primary" value="Crear" form="createStudentForm">
        @endslot
    @endcomponent

    <!--Botones para manipular tabla de estudiantes y buscador-->
    <div class="btn-toolbar mb-3 w-100 form-inline" role="toolbar" aria-label="Toolbar with button groups">

        {{-- Botón de Nuevo --}}
        <div class="btn-group mr-2" role="group" aria-label="First group">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newStudentModal">Nuevo</button>
        </div>

        

        <!-- Formulario para buscar -->
        <form class="form col-auto mr-0 ml-auto form-inline" action="/alumnos/" method="get">

            {{-- Filtros --}}
            <select class="form-control mr-3 ml-auto">
                <option>Todos los alumnos</option>
                <option>Alumnos sin grupo activo</option>
            </select>

            {{-- Buscador --}}
            <div class="input-group ">
                <input type="text" class="form-control w-auto" placeholder="Escriba algo..." value="{{ app('request')->input('keyword') }}" aria-describedby="btnGroupAddon" name="keyword">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary" type="button">Buscar</button>
                </div>
            </div>
        </form>
    </div>

</div>

<div class="">

    <!-- Tabla de estudiantes -->
    @include('tables.students')

    <!-- Botones de paginación -->
    <div class="row">
        <div class="mx-auto">
            {{ $students->appends($_GET)->links('pagination::bootstrap-4') }}
        </div>
    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">

    var selectedId;

    //Método para que cuando un renglón de la tabla esté seleccionado este cambie de color
    function selectStudent(id) {
        var row = document.getElementById("studentRow" + id);
        var chk = document.getElementsByName("studentCheckbox" + id);
        if (chk[0].checked) {

            row.className = "table-active";

            //console.log(row);

            //Obtener las otras rows y deseleccionarlas
            if(selectedId != null){
                var previousRow = document.getElementById("studentRow" + selectedId);
                var previousChk = document.getElementsByName("studentCheckbox" + selectedId);
                previousRow.className = "";
                previousChk[0].checked = false;
            }

            //Establecer el ID como el seleccionado actual
            selectedId = id;
            document.forms['deleteStudentForm'].elements[0].value = selectedId;

        } else {
            row.className = "";
            selectedId = null;
            document.forms['deleteStudentForm'].elements[0].value = null;
        }

    }

</script>

<!-- Si hubo un error en el formulario de nuevo estudiante, abrir modal automaticamente -->
@if($errors->any())
    <script type="text/javascript">
        var $errorMessage = '';
        @foreach($errors->all() as $error)
            $errorMessage = $errorMessage + ' {{ $error }}';
        @endforeach
        //alert($errorMessage);
        
        //Abrir modal de estudiante
        $( document ).ready(function() {
            $('#newStudentModal').modal('show');
        });
        
    </script>
@endif

@endsection

