<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('color'))
{    
	function color($idColor)
	{
		$ci = &get_instance();
		$ci->load->model('color_model');
		$var = $ci->color_model->getColorRow($idColor);
        
        return $var;
	}
}