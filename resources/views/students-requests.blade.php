@extends('layouts.app')
@section('title', 'Solicitudes')
@section('section', 'Solicitudes')

@section('content')

<div>
   
    <!--Botones para manipular tabla de estudiantes y buscador-->
    <div class="btn-toolbar mb-3 w-100 form-inline" role="toolbar" aria-label="Toolbar with button groups">

<p class="text-muted">Se aceptaran a los alumnos que hayan hecho el pago de su ficha de inscripción.</p>

        <!-- Formulario para buscar -->
        <form class="form col-auto mr-0 ml-auto form-inline" action="{{ route('students') }}" method="get">

            {{-- Orden --}}
            <select class="form-control mr-3 ml-auto" name="order" onchange="this.form.submit()">
                <option value="1" {{ app('request')->input('order') == 1 ? 'selected' : '' }}>Ordenar por ID</option>
                {{--<option value="2" {{ app('request')->input('order') == 2 ? 'selected' : '' }}>Ordenar por estado</option>--}}
                <option value="3" {{ app('request')->input('order') == 3 ? 'selected' : '' }}>Ordenar por apellidos</option>
                <option value="4" {{ app('request')->input('order') == 4 ? 'selected' : '' }}>Ordenar por carrera</option>
            </select>

            {{-- Filtros --}}
            <select class="form-control mr-3 ml-auto" name="filter" onchange="this.form.submit()">
                <option value="1">Todos los alumnos</option>
                <option value="2" {{ app('request')->input('filter') == 2 ? 'selected' : '' }}>Alumnos activos</option>
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
    @include('tables.inactive-students')

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

@endsection

