<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$asunto		= trim($this->input->post('asunto'));
		$nombre 	= trim($this->input->post('nombre'));
		$email		= trim($this->input->post('email'));
		$mensaje	= trim($this->input->post('mensaje'));
		
		//DATOS VACIOS
		if( $nombre == "" || $email == "" || $mensaje == "" ){
			echo "TODOS LOS CAMPOS OBLIGATORIOS.";	
			return;
		}
		
		//EMAIL VÁLIDO
		if( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
			echo 'EMAIL NO VÁLIDO.';	
			return;				
		}
		
		//PASA A PHPMAILER
		$exito = email_formulario($nombre,$email,$mensaje,$asunto);
		
		//ERROR DE ENVÏO
		if( !$exito ){
			echo 'ERROR DE ENVÍO, INTENTARLO NUEVAMENTE.';	
			return;				
		}
		
		//EXITOSO
		if( $exito ){
			echo '';	
			return;	
		}
		
	}
	
	public function recuperarpass()
	{
		$asunto = trim($this->input->post('asunto'));
		$email	= trim($this->input->post('email'));
		
		//DATOS VACIOS
		if( $email == "" ){
			echo "EMAIL OBLIGATORIO.";	
			return;
		}
		
		//EMAIL VÁLIDO
		if( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
			echo 'EMAIL NO VÁLIDO.';	
			return;				
		}
		
		//EMAIL NO EXISTE
		if( count($this->empresa_model->getEmpresaEmailExiste($email)) == 0 ){
			echo 'EMAIL NO ASOCIADO A NINGUNA EMPRESA.';	
			return;				
		}
		
		//DATOS EMPRESA
		$empresa	= $this->empresa_model->getEmpresaEmailExiste($email);
		$idEmpresa	= $empresa->EMPRESA_ID;
		$nmbEmpresa	= $empresa->EMPRESA_NOMBRE;
		
		$nuevoPass = generaPass();
		
		//UPDATE PASS		
		$empresa = $this->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_PASS',md5($nuevoPass));
		
		//PASA A PHPMAILER
		$exito = email_recuperar_pass($nmbEmpresa,$email,$asunto,$nuevoPass);
		
		//ERROR DE ENVÏO
		if( !$exito ){
			echo 'ERROR DE ENVÍO, INTENTARLO NUEVAMENTE.';
			return;				
		}
		
		//EXITOSO
		if( $exito ){
			echo '';	
			return;	
		}
		
	}
	
	public function formcliente()
	{
		$asunto		= trim($this->input->post('asunto'));
		$nombre 	= trim($this->input->post('nombre'));
		$email		= trim($this->input->post('email'));
		$mensaje	= trim($this->input->post('mensaje'));
		
		//DATOS VACIOS
		if( $nombre == "" || $email == "" || $mensaje == "" ){
			echo "TODOS LOS CAMPOS OBLIGATORIOS.";	
			return;
		}
		
		//EMAIL VÁLIDO
		if( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
			echo 'EMAIL NO VÁLIDO.';
			return;				
		}
		
		//PASA A PHPMAILER
		$exito = email_formulario($nombre,$email,$mensaje,$asunto);
		
		//ERROR DE ENVÏO
		if( !$exito ){
			echo 'ERROR DE ENVÍO, INTENTARLO NUEVAMENTE.';
			return;				
		}
		
		//EXITOSO
		if( $exito ){
			echo '';	
			return;	
		}
		
	}
	
}
