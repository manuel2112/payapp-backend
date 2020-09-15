<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('pagination_show'))
{    
	function pagination_show($url,$countUrl,$porPagina,$uriSegment)
	{
        //pagination settings
        $config['base_url'] = $url;
        $config['total_rows'] = $countUrl;
        $config['per_page'] = $porPagina;
        $config["uri_segment"] = $uriSegment;
        $choice = $config["total_rows"] / $config["per_page"];
        $config['num_links'] = 2;
        //config for bootstrap pagination class integration
		$config['full_tag_open'] 	= '<div class="pagging"><nav><ul class="pagination">';
		$config['full_tag_close'] 	= '</ul></nav></div>';
		$config['num_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['num_tag_close'] 	= '</span></li>';
		$config['cur_tag_open'] 	= '<li class="page-item active"><span class="page-link">';
		$config['cur_tag_close'] 	= '<span class="sr-only">(current)</span></span></li>';
		$config['next_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['next_tagl_close'] 	= '<span aria-hidden="true">&raquo;</span></span></li>';
		$config['prev_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['prev_tagl_close'] 	= '</span></li>';
		$config['first_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['first_tagl_close'] = '</span></li>';
		$config['last_tag_open'] 	= '<li class="page-item"><span class="page-link">';
		$config['last_tagl_close'] 	= '</span></li>';
		
		return $config;
	}
}