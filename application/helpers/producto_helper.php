<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('productoPorTipo'))
{
	function productoPorTipo($id)
	{
		$ci = &get_instance();
		$ci->load->model('producto_model');
		$var = $ci->producto_model->getProductoPorTipo($id);
        
        return $var;
	}
}

if(!function_exists('variablePorProducto'))
{
	function variablePorProducto($id)
	{
		$ci = &get_instance();
		$ci->load->model('producto_variable_model');
		$var = $ci->producto_variable_model->getProductoVariable($id);
        
        return $var;
	}
}