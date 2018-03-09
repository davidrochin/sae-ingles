@extends('layouts.app')
@section('title', 'Alumnos')
@section('section', 'Alumnos')
@section('content')
<div class="">

    <!-- Modal para agregar un estudiante -->
    <div class="modal fade in" id="newStudentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Nuevo estudiante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- Cuerpo del Modal -->
                <div class="modal-body">

                    <!-- Formulario de nuevo alumno -->
                    <form class="form" action="/alumnos/crear" method="post" id="createStudentForm">

                        <!-- Crear el token de seguridad -->
                        {{ csrf_field() }}

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="controlNumberControlInput">Número de control</label>
                                    <input type="text" id="controlNumberControlInput" name="controlNumber" class="form-control {{ $errors->has('controlNumber') ? 'is-invalid' : '' }}" value="{{ old('controlNumber') }}">
                                    <div class="invalid-feedback">{{ $errors->first('controlNumber') }}</div>
                                </div>
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
                        <div class="form-group">
                            <label for="firstNamesControlInput">Nombre(s)</label>
                            <input type="text" id="firstNamesControlInput" name="firstNames" class="form-control {{ $errors->has('firstNames') ? 'is-invalid' : ''}}" value="{{ old('firstNames') }}">
                            <div class="invalid-feedback">{{ $errors->first('firstNames') }}</div>
                        </div>
                        <div class="form-group">
                            <label for="lastNamesControlInput">Apellido(s)</label>
                            <input type="text" id="lastNamesControlInput" name="lastNames" class="form-control {{ $errors->has('lastNames') ? 'is-invalid' : ''}}" value="{{ old('lastNames') }}">
                            <div class="invalid-feedback">{{ $errors->first('lastNames') }}</div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="phoneNumberControlInput">Número telefónico</label>
                                    <input type="tel" id="phoneNumberControlInput" name="phoneNumber" class="form-control {{ $errors->has('phoneNumber') ? 'is-invalid' : '' }}" value="{{ old('phoneNumber') }}">
                                    <div class="invalid-feedback">{{ $errors->first('phoneNumber') }}</div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="form-group">
                                    <label for="emailControlInput">Correo electrónico</label>
                                    <input type="email" id="emailControlInput" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}">
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-primary" value="Crear" form="createStudentForm">
                </div>
            </div>
        </div>
    </div>

    <!-- Alerta de éxito -->
    @if(session()->get('success'))
    <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif

    <!--Botones para manipular tabla de estudiantes y buscador-->
    <div class="btn-toolbar mb-3 w-100" role="toolbar" aria-label="Toolbar with button groups">
        <div class="btn-group" role="group" aria-label="First group">
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#newStudentModal">Nuevo</button>
        </div>

        <!-- Formulario para buscar -->
        <form class="form col-auto mr-0 ml-auto" action="/alumnos/" method="get">
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
    
    <!--<div class="w-100">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>-->

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
        alert($errorMessage);
        
        //Abrir modal de estudiante
        $( document ).ready(function() {
            $('#newStudentModal').modal('show');
        });
        
    </script>
@endif

@endsection

