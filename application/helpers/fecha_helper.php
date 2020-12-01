<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('dateDb'))
{
	function dateDb($fecha)
	{
		$day	=	substr($fecha,0,2);
		$month	=	substr($fecha,4,2);
		$year	=	substr($fecha,6,4);
		$valor 	= $year."-".$month."-".$day;
		return $valor;
	}
}

if(!function_exists('dateDiaMes'))
{
	function dateDiaMes($fecha)
	{
	$fecha = date_create_from_format('Y-m-d', $fecha);	
//		$year	=	substr($fecha,0,4);
//		$month	=	substr($fecha,5,2);
//		$day	=	substr($fecha,8,2);
//		$valor 	= $day."/".$month;
		return date_format($fecha, 'Y-m-d');
	}
}

if(!function_exists('date_datetime'))
{
	function date_datetime($fecha)
	{
		$dia		= substr($fecha, 0, 2);
		$mes		= substr($fecha, 3, 2);
		$anno		= substr($fecha, 6, 4);
		$hora		= substr($fecha, 11, 2);
		$minuto		= substr($fecha, 14, 2);
		$segundo	= "00";
		$fechaOk	= $anno."-".$mes."-".$dia." ".$hora.":".$minuto.":".$segundo;	
		return $fechaOk;
	}
}

if(!function_exists('zonaHoraria'))
{	
	function zonaHoraria(){		
		$zona = date_default_timezone_set('America/Santiago');
		//$zona = date_default_timezone_set("America/New_York");
		return $zona;
	}
}

if(!function_exists('fechaNowPass'))
{	
	function fechaNowPass(){
		zonaHoraria();
		$var = date("H").date("d").date("m");
		return $var;
	}		
}

if(!function_exists('fechaNow'))
{	
	function fechaNow(){
		zonaHoraria();
		$var = date("Y-m-d H:i:s");
		return $var;
	}		
}

if(!function_exists('fechaHaceUnMes'))
{	
	function fechaHaceUnMes(){
		zonaHoraria();
		$stop_date	= fechaNow();
		$mesAtras	= date('Y-m-d', strtotime($stop_date . '-30 day'));
		return $mesAtras;
	}		
}

if(!function_exists('fechaMasUnMes'))
{	
	function fechaMasUnMes($fecha){
		$stop_date	= $fecha;
		$mesMas	= date('Y-m-d', strtotime($stop_date . '+31 day'));
		return $mesMas;
	}		
}

if(!function_exists('fechaMasUnDia'))
{	
	function fechaMasUnDia($fecha){
		zonaHoraria();
		$stop_date	= date($fecha);
		$masUnDia	= date('Y-m-d', strtotime($stop_date . '+1 day'));
		return $masUnDia;
	}		
}

if(!function_exists('fechaLatina'))
{
	function fechaLatina($fecha)
	{
		$day=substr($fecha,8,2);
		$month=substr($fecha,5,2);
		$year=substr($fecha,0,4);
		$hour = substr($fecha,11,5);
		$datetime_format = $day."-".$month."-".$year.' '.$hour;
		if( $fecha == '' ){
			$datetime_format = '';
		}
		return $datetime_format;
	}
}

if(!function_exists('diaSemanaNmb'))
{
	function diaSemanaNmb($day)
	{
		switch ($day) {
			case 1:
				$day = "LUNES";
				break;
			case 2:
				$day = "MARTES";
				break;
			case 3:
				$day = "MIÉRCOLES";
				break;
			case 4:
				$day = "JUEVES";
				break;
			case 5:
				$day = "VIERNES";
				break;
			case 6:
				$day = "SÁBADO";
				break;
			case 7:
				$day = "DOMINGO";
				break;
		}
		return $day;
	}
}
