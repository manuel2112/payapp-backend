<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('tipoNegocio'))
{    
	function tipoNegocio($idEmpresa,$idTipo)
	{
		$ci = &get_instance();
		$ci->load->model('empresa_negocio_model');
        $var = $ci->empresa_negocio_model->getEmpresaNegocioRow($idTipo,$idEmpresa);
        
        $obs = $var ? $var->EMPRESA_TIPO_NEGOCIO_OBS : '' ;
        
        return $obs;
	}
}