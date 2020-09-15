<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('imgDefecto'))
{    
	function imgDefecto()
	{
		$variable = base_url('public/images/food-defecto.png');
		return $variable;
	}
}