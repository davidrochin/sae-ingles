		@extends('layouts.blank')
		@section('title', 'Carta de acreditación TOEFL')
		@section('content')
{{--VARIABLES
*NOMBRE
*NO CONTROL
*CARRERA
    fecha
 *int DIA
 *str MES
 *str AÑO


	--}}	


	<div class="contenido">




<p class="saludo"><b>A QUIEN CORRESPONDA: </b></p>
				<div class="info-text">
					<p>La que suscribe Jefa del Departamento de Gestión Tecnológica y Vinculación de este Instituto, hace constar que el (la) alumno (a):</p>

				</div>

				<div class="info-alumno">
					
					<table class="tabla-alumno">
	 <tr>
	  <td><b>NOMBRE:</b></td> <td><b>{{$student->last_names}} {{$student->first_names}}</b></td>
	 </tr>
	 <tr>
	  <td><b>No. DE CONTROL:</b></td> <td><b>{{$student->control_number}}</b></td>
	 </tr>
	 <tr>
	  <td><b>CARRERA:</b></td> <td><b>{{ !is_null($student->career) ? $student->career->short_name : 'Carrera no registrada' }} </b></td>
	 </tr>

	  			</table> 

				</div>{{--fin del div de tabla--}}

				<div class="info-text">
				
				<p>Acreditó la comprensión de artículos técnicos científicos en el idioma Inglés para efectos de titulación.</p>
				<p>A petición del interesado y para los fines legales que mejor le convengan, se extiende la presente en la Ciudad de Los Mochis, Sinaloa, a los {{ $fecha }}. </p>	
			


 

			
				</div>
				
				<div class="despedida">
					<p><b>	A T E N T A M E N T E</b></p>
					<p class="d2"><b><em>Excelencia en Educación Tecnológica®</em></b></p>
					<p class="d3"><em>“EL PROGRESO COMO META, LOS PRINCIPIOS COMO GUÍA”</em></p>

				</div>

				<div class="autoridades">
				
					<table >
				    <tr>
	                <td><b>M. en C. CLAUDIA ALARCÓN VALDEZ</b></td> <td><b>Vo.Bo. MC. MARIO FLORES LÓPEZ</b></td>
	                </tr>
	                <tr>
	                <td>JEFA DEL DEPARTAMENTO DE GESTIÓN TECNOLÓGICA Y VINCULACIÓN</td> 
	                <td>SUBDIRECTOR DE PLANEACIÓN Y VINCULACIÓN</td>
	                </tr>
	                </table>
				</div>

<p class="codigo">MFL/CAV/blga</p>




</div>
		@endsection
	
@section('scripts')

<script type="text/javascript">

	//Abrir el documento en modo de impresión
	$(document).ready( function(){
		window.print();
	});
</script>

<style type="text/css">
	.table-attendance th {
		font-size: 1.2rem;
	}
	.table-attendance td {
		padding-bottom: 0.3rem;
		padding-top: 0.3rem;
		font-size: 1.2rem;
	}
</style>

@endsection
	