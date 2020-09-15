<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('horarioPorEmpresa'))
{
	function horarioPorEmpresa()
	{
		zonaHoraria();
		$ci = &get_instance();
		$ci->load->model('empresa_model');
		$empresas = $ci->empresa_model->getEmpresasActivas();
		foreach( $empresas as $item ){
			$horaCierreEmpresa = updateHorario($item->EMPRESA_ID);
			if( $horaCierreEmpresa != '' ){
				echo 'EMPRESA '.$item->EMPRESA_NOMBRE.' ABIERTA, HASTA LAS '.$horaCierreEmpresa.'<br>';
			}
			echo fechaProxApertura($item->EMPRESA_ID).'<br>';
		}
	}
}

if(!function_exists('horarioPorEmpresaSingle'))
{
	function horarioPorEmpresaSingle($idEmpresa)
	{
		zonaHoraria();
		$horaCierreEmpresa = updateHorario($idEmpresa);
		if( $horaCierreEmpresa != '' ){
			return 'ABIERTO, HASTA LAS '.$horaCierreEmpresa;
		}
		return fechaProxApertura($idEmpresa);
	}
}


if(!function_exists('fechaProxApertura'))
{
	function fechaProxApertura($idEmpresa)
	{
		zonaHoraria();
		$ci = &get_instance();
		//$ci->load->library('session');
		$ci->load->model('empresa_model');
		$empresa 	= $ci->empresa_model->getEmpresaRow($idEmpresa);
		$hoy		= date('N');
		$arreglo 	= array();
		$i 			= 0;
		$faltaParaAbrir = '';

		if( !$empresa->EMPRESA_ABIERTO ){
			$horario	= $ci->horario_model->getHorarioPorEmpresa($idEmpresa);
			foreach( $horario as $item ){
				if( $item->HORARIO_DIA_OPEN < $hoy ){
					$dayAdd = 7 - $hoy + $item->HORARIO_DIA_OPEN;
				}else{
					$dayAdd = $item->HORARIO_DIA_OPEN - $hoy;
				}
				$arreglo[$i++] = dateShow($dayAdd,$item->HORARIO_HORA_OPEN);
			}

			sort($arreglo);
			foreach( $arreglo as $item ){
				if( mkTimeNow() < $item ){
					$falta = $item - mkTimeNow();
					//$faltaParaAbrir = tiempoFaltante($falta);
					return $falta;
					//break;
				}
			}

			//$texto = count($arreglo) > 0 ? 'FALTA: '.$faltaParaAbrir.' PARA ABRIR.' : ' SIN DATOS INGRESADOS.' ;
			//updateHorario($idEmpresa);
			//return $faltaParaAbrir;
			//if ($ci->session->userdata('clienteapppay')) {
			//	return 'CERRADO, '.$texto.'<br>';
			//}else{
			//	return 'EMPRESA '.$empresa->EMPRESA_NOMBRE.' CERRADA, '.$texto.'<br>';
			//}
		}
	}
}

if(!function_exists('tiempoFaltante'))
{
	function tiempoFaltante($segs)
	{
		$cadena = "";
		if($segs >= 86400) {
			$dias = floor($segs/86400);
			$segs = $segs%86400;
			$cadena = $dias.' día';
			if($dias != 1) $cadena .= 's';
			if($segs >= 0) $cadena .= ', ';
		}
		if($segs>=3600){
			$horas = floor($segs/3600);
			$segs = $segs%3600;
			$cadena .= $horas.' hora';
			if($horas != 1) $cadena .= 's';
			if($segs >= 0) $cadena .= ', ';
		}
		if($segs>=60){
			$minutes = floor($segs/60);
			$segs = $segs%60;
			$cadena .= $minutes.' minuto';
			if($minutes != 1) $cadena .= 's';
			if($segs >= 0) $cadena .= ', ';
		}
		$cadena .= $segs.' segundo';
		if($segs != 1) $cadena .= 's';
		
		return $cadena;
	}
}

if(!function_exists('dateShow'))
{
	function dateShow($n,$hour)
	{
		$fecha = date('Y-m-d');
		$nuevaFecha =  date('Y-m-d', strtotime($fecha. ' + '.$n.' days'));
		$valor = $nuevaFecha.' '.$hour;
		return mkTimeCustom($valor);
	}
}

if(!function_exists('mkTimeCustom'))
{
	function mkTimeCustom($fecha)
	{
		$hora 		= substr($fecha, 11, 2);
		$minuto		= substr($fecha, 14, 2);
		$segundos	= substr($fecha, 17, 2);
		$mes		= substr($fecha, 5, 2);
		$dia		= substr($fecha, 8, 2);
		$anno		= substr($fecha, 0, 4);
		$valor		= mktime($hora, $minuto, $segundos, $mes, $dia, $anno);
		return $valor;
	}
}

if(!function_exists('updateHorario'))
{
	function updateHorario($idEmpresa)
	{
		zonaHoraria();
		$ci = &get_instance();
		$ci->load->model('horario_model','empresa_model');
		$horario	= $ci->horario_model->getHorarioPorEmpresa($idEmpresa);
		//RESETEAR HORARIO A 0
		$ci->horario_model->updateResetHorario($idEmpresa);

		//INSTANCIAR EMPRESA CERRADA
		$ci->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_ABIERTO',FALSE);

		$horaCierre = '';
		$hoy		= date('N');
		$ahora 		= mkTimeNow();
		$txt = '';

		foreach( $horario as $item ){

			//MISMO DIA APERTURA
			if( $hoy == $item->HORARIO_DIA_OPEN ){

				$apertura 	= mkTimeValor($item->HORARIO_HORA_OPEN);
				$cierre 	= mkTimeValor($item->HORARIO_HORA_CLOSE);

				//COMPROBAR EMPRESA ABIERTA
				if( $ahora >= $apertura && $ahora <= $cierre){
					$ci->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_ABIERTO',TRUE);
					$ci->horario_model->updateOpenHorario($item->HORARIO_ID);
					$horaCierre = $item->HORARIO_HORA_CLOSE;
					break;
				}
				if( $ahora >= $apertura && $item->HORARIO_DIA_OPEN != $item->HORARIO_DIA_CLOSE ){
					$ci->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_ABIERTO',TRUE);
					$ci->horario_model->updateOpenHorario($item->HORARIO_ID);
					$horaCierre = $item->HORARIO_HORA_CLOSE;
					break;
				}
			}

			//MISMO DIA CIERRE
			if( $item->HORARIO_DIA_OPEN != $item->HORARIO_DIA_CLOSE && $hoy == $item->HORARIO_DIA_CLOSE ){

				$cierre = mkTimeValor($item->HORARIO_HORA_CLOSE);

				//COMPROBAR EMPRESA ABIERTA
				if( $ahora <= $cierre){
					$ci->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_ABIERTO',TRUE);
					$ci->horario_model->updateOpenHorario($item->HORARIO_ID);
					$horaCierre = $item->HORARIO_HORA_CLOSE;
					break;
				}
			}

		}
		return $horaCierre ;
	}
}

if(!function_exists('mkTimeNow'))
{
	function mkTimeNow()
	{
		$horaNow 		= date('H');
		$minutoNow 		= date('i');
		$segundosNow	= date('s');
		$mesNow 		= date('m');
		$diaNow 		= date('d');
		$annoNow 		= date('Y');
		$valor 			= mktime($horaNow, $minutoNow, $segundosNow, $mesNow, $diaNow, $annoNow);
		return $valor;
	}
}

if(!function_exists('mkTimeValor'))
{
	function mkTimeValor($fecha)
	{
		$mesNow		= date('m');
		$diaNow		= date('d');
		$annoNow	= date('Y');				
		$hora		= substr($fecha, 0, 2);
		$minutos	= substr($fecha, 3, 2);
		$valor		= mktime($hora, $minutos, 00, $mesNow, $diaNow, $annoNow);
		return $valor;
	}
}