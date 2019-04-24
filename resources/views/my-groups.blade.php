@extends('layouts.app')
@section('title', 'Mis Grupos')
@section('section', 'Mis Grupos')

@section('content')

<div class="">

</div>

<div class="">

	{{-- Tabla de grupos --}}
	@include('tables.my-groups')

	{{-- Botones de paginación --}}
	<div class="row">
	    <div class="mx-auto">
	        {{ $groups->appends($_GET)->links('pagination::bootstrap-4') }}
	    </div>
	</div>
</div>

@endsection

@section('scripts')
	<script type="text/javascript">
		function ajustaFechas() {
            var periodo = createGroupForm.periodControlInput;
            var currentdate = new Date();
            var mes = currentdate.getMonth()+1;
            if(mes >= 1 && mes <=6){         //de enero a junio
                periodo.value = 1;           //ene-jun

			}else if(mes == 7){              //solo julio
                periodo.value = 2;           //verano
                
			}else if(mes >= 8 && mes <= 12){ //de agosto a diciembre 
                periodo.value = 3;           //ago-dic
			}
			else if(mes == 12){              //solo diciembre
                periodo.value = 4;           //invierno
			}
        }
	</script>

@endsection