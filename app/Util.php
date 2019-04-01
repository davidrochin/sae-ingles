<?php

namespace App;


class Util 
{
	static function basico($numero) {
	$valor = array ('Uno','Dos','Tres','Cuatro','Cinco','Seis','Siete','Ocho',
	'Nueve','Diez', 'Once','Doce','Trece','Catorce','Quince','Dieciséis','Diecisiete','Dieciocho','Diecinueve','Veinte','Veintiuno','Veintidos','Veintitres', 'Veinticuatro','Veinticinco',
	'Veintiséis','Veintisiete','Veintiocho','Veintinueve');
	return $valor[$numero - 1];
	}

	static function decenas($n) {
	$decenas = array (30=>'Treinta',40=>'Cuarenta',50=>'Cincuenta',60=>'Sesenta',
	70=>'Setenta',80=>'Ochenta',90=>'Noventa');
		if( $n <= 29) return Util::basico($n);
				$x = $n % 10;
				if ( $x == 0 ) {
							return $decenas[$n];
	} else return $decenas[$n - $x].' y '. Util::basico($x);
	}
 
	static function centenas($n) {
	$cientos = array (100 =>'Cien',200 =>'Doscientos',300=>'Trecientos',
	400=>'Cuatrocientos', 500=>'Quinientos',600=>'Seiscientos',
	700=>'Setecientos',800=>'Ochocientos', 900 =>'Novecientos');
		if( $n >= 100) {
			if ( $n % 100 == 0 ) {
					return $cientos[$n];
			} else {
					$u = (int) substr($n,0,1);
					$d = (int) substr($n,1,2);
			return (($u == 1)?'ciento':$cientos[$u*100]).' '.Util::decenas($d);
	}
	} else return Util::decenas($n);
	}
 
	static function miles($n) {
	if($n > 999) {
	if( $n == 1000) {return 'Mil';}
	else {
	$l = strlen($n);
	$c = (int)substr($n,0,$l-3);
	$x = (int)substr($n,-3);
	if($c == 1) {$cadena = 'Mil '.Util::centenas($x);}
		else if($x != 0) {$cadena = Util::centenas($c).' Mil '.Util::centenas($x);}
			else $cadena = Util::centenas($c). ' Mil';
	return $cadena;
	}
	} else return Util::centenas($n);
	}
	 


	public static function convertir($n) {
	switch (true) {
	case ( $n >= 1 && $n <= 29) : return Util::basico($n); break;
	case ( $n >= 30 && $n < 100) : return Util::decenas($n); break;
	case ( $n >= 100 && $n < 1000) : return Util::centenas($n); break;
	case ($n >= 1000 && $n <= 999999): return Util::miles($n); break;
	
	}
	}
 
 

}


