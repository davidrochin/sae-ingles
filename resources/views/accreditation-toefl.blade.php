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


	<div class="d-flex justify-content-between encabezado">
<img height="200px" src="img/sep.jpg">
<div class="col">
	<img height="100px" src="img/tecnm.png">	
	<p>Instituto Tecnológico de Los Mochis</p>
</div>

</div>


	


<p class="saludo"><b>A QUIEN CORRESPONDA: </b></p>
				<div class="info-text">
					<p>La que suscribe Jefa del Departamento de Gestión Tecnológica y Vinculación de este Instituto, hace constar que el (la) alumno (a):</p>

				</div>

				<div class="info-alumno">
					
					<table class="tabla-alumno">
	 <tr>
	  <td><b>NOMBRE:</b></td> <td><b>GUEVARA SÁNCHEZ OSWALDO</b></td>
	 </tr>
	 <tr>
	  <td><b>No. DE CONTROL:</b></td> <td><b>14440600</b></td>
	 </tr>
	 <tr>
	  <td><b>CARRERA:</b></td> <td><b>INF. INFORMATICA</b></td>
	 </tr>

	  			</table> 

				</div>{{--fin del div de tabla--}}

				<div class="info-text">
				
				<p>Acreditó la comprensión de artículos técnicos científicos en el idioma Inglés para efectos de titulación.</p>
				<p>A petición del interesado y para los fines legales que mejor le convengan, se extiende la presente en la Ciudad de Los Mochis, Sinaloa, a los 29 días del mes de octubre del año Dos Mil Dieciocho. </p>	
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



<div class="d-flex justify-content-between piedepagina">
<img  class="imagenes-pie" src="img/logo.png">
<div>
	<strong>
	<p>Blvd. Juan de Dios Batiz y 20 de Noviembre</p>
	<p>C.P. 81259  Los Mochis, Sin.Teléfonos:  (01-668) 812-58-58, 812-59-59 e-mail: <em class="correo">dir_mochis@tecnm.mx</em></p>
	<p> www.itmochis.edu.mx</p>
</strong>
</div>
<img class="imagenes-pie" src="img/toefl.png">	
</div>

</div>
		@endsection
		