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

if(!function_exists('getNmbProducto'))
{
	function getNmbProducto($id)
	{
		$ci = &get_instance();
		$ci->load->model('producto_model');
		if( $id == 0 ){
			$var = '-----';
		}else{
			$producto = $ci->producto_model->getProductoRow($id);
			if( $producto ){
				$var = $producto->PRODUCTO_NOMBRE;
			}else{
				$var = 'PRODUCTO NO EXISTENTE';
			}
		}		
        
        return $var;
	}
}