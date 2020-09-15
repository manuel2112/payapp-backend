<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('timeOut'))
{    
	function timeOut($startTime)
	{
		$timeLimit 	= 110;
		$valor		= FALSE;
		
		if (time() - $startTime > $timeLimit)
		{
			$valor	= TRUE;
		}
		return $valor;
	}
}
