
{{-- Imprimir un badge para cada dia de la semana que tenga $days --}}
{{--    1 = Lunes
		2 = Martes
		3 = Miercoles
		4 = Jueves
		5 = Viernes
		6 = Sábado
		7 = Domingo (no se usa) --}}

@if(strpos($days, '1') !== false)
Lun
@endif

@if(strpos($days, '2') !== false)
Mar
@endif

@if(strpos($days, '3') !== false)
Mie
@endif

@if(strpos($days, '4') !== false)
Jue
@endif

@if(strpos($days, '5') !== false)
Vie
@endif

@if(strpos($days, '6') !== false)
Sab
@endif

@if(strpos($days, '7') !== false)
Dom
@endif