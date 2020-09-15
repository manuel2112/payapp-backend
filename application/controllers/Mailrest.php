<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;

class MailRest extends REST_Controller {
	
	public function __construct(){
		
		header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		header("Access-Control-Allow-Origin: *");
	
		parent::__construct();
				
	}
	
	public function index()
	{
	}
	
	public function mail_send_post()
	{
		$data 		= $this->post();
		$nombre 	= $data['nombre'];
		$email		= $data['email'];
		$mensaje	= $data['mensaje'];
		$asunto		= "Formulario Contacto APP";
		
		//DATOS VACIOS
		if( $nombre == "" || $email == "" || $mensaje == "" ){
			$respuesta = array(
								'error' 	=> TRUE, 
								'mensaje'	=> 'ERROR, TODOS LOS CAMPOS OBLIGATORIOS.'
							   );		
			$this->response($respuesta);	
			return;				
		}
		
		//EMAIL VÁLIDO
		if( !filter_var($email,FILTER_VALIDATE_EMAIL) ){
			$respuesta = array(
								'error' 	=> TRUE, 
								'mensaje'	=> 'ERROR, EMAIL NO VÁLIDO.'
							   );		
			$this->response($respuesta);	
			return;				
		}
		
		//PASA A PHPMAILER
		$exito = email_formulario($nombre,$email,$mensaje,$asunto);
		
		//ERROR DE ENVÏO
		if( !$exito ){
			$respuesta = array(
								'error' 	=> TRUE, 
								'mensaje'	=> 'ERROR DE ENVÍO, INTENTARLO NUEVAMENTE.'
							   );		
			$this->response($respuesta);	
			return;				
		}
		
		//EXITOSO
		if( $exito ){
			$respuesta = array(
								'error' 	=> FALSE, 
								'mensaje'	=> 'DATOS CORRECTOS'
							   );		
			$this->response($respuesta);	
			return;	
		}
		
	}
	
}
