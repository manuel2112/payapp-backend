<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('email_formulario'))
{    
	function email_formulario($nombre,$email,$mensaje,$asunto)
	{
		
		$mensaje = "<table border='1'>
						<tr><td>Nombre</td><td>".$nombre."</td></tr>
						<tr><td>Email</td><td>".$email."</td></tr>
						<tr><td>Mensaje</td><td>".$mensaje."</td></tr>
					</table>";
		
		$mail = new PHPMailer();
		//$mail->IsSMTP();
		$mail->CharSet  = "UTF-8";
		$mail->Host		= "mail.localfood.cl";
		$mail->SMTPAuth = true;
		$mail->Username = "contacto@localfood.cl";
		$mail->Password = "c3Kqo{rGjEt7";
		$mail->From		= $email;
		$mail->FromName	= $nombre;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->AddAddress('contacto@localfood.cl');
		$mail->AddBCC('manuel2112@hotmail.com');
		$mail->Subject	= $asunto;
		$mail->Body    	= $mensaje;
		$mail->AltBody 	= "Favor configurar su correo para leer HTML.";
		return $mail->Send();
	}
}

if(!function_exists('email_recuperar_pass'))
{    
	function email_recuperar_pass($empresa,$email,$asunto,$password)
	{
		
		$mensaje = "<table border='1'>
						<tr><td>Estimado(a) usuario de '".$empresa."':<br><br>
						Esta es su nueva contraseña <strong>'".$password."'</strong> en su cuenta '".$email."'.<br>
						Para ingresar nuevamente, úsela en el siguiente enlace.<br><br>
						<a href='".base_url()."login'>INGRESAR</a></td></tr>
					</table>";
		
		$mail = new PHPMailer();
		//$mail->IsSMTP();
		$mail->CharSet  = "UTF-8";
		$mail->Host		= "mail.localfood.cl";
		$mail->SMTPAuth = true;
		$mail->Username = "contacto@localfood.cl";
		$mail->Password = "c3Kqo{rGjEt7";
		$mail->From		= $email;
		$mail->FromName	= $empresa;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->AddAddress($email);
		$mail->AddBCC('contacto@localfood.cl');
		$mail->AddBCC('manuel2112@hotmail.com');
		$mail->Subject	= $asunto;
		$mail->Body    	= $mensaje;
		$mail->AltBody 	= "Favor configurar su correo para leer HTML.";
		return $mail->Send();
	}
}

if(!function_exists('email_permisos_ingreso'))
{    
	function email_permisos_ingreso($empresa,$email,$asunto,$password)
	{
		
		$mensaje = "<table border='1'>
						<tr><td>Estimado(a) usuario de '".$empresa."':<br><br>
						Esta es su nueva contraseña <strong>'".$password."'</strong> en su cuenta '".$email."'.<br>
						Para ingresar úsela en el siguiente enlace.<br><br>
						<a href='".base_url()."login'>INGRESAR</a></td></tr>
					</table>";
		
		$mail = new PHPMailer();
		//$mail->IsSMTP();
		$mail->CharSet  = "UTF-8";
		$mail->Host		= "mail.localfood.cl";
		$mail->SMTPAuth = true;
		$mail->Username = "contacto@localfood.cl";
		$mail->Password = "c3Kqo{rGjEt7";
		$mail->From		= $email;
		$mail->FromName	= $empresa;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->AddAddress($email);
		$mail->AddBCC('contacto@localfood.cl');
		$mail->AddBCC('manuel2112@hotmail.com');
		$mail->Subject	= $asunto;
		$mail->Body    	= $mensaje;
		$mail->AltBody 	= "Favor configurar su correo para leer HTML.";
		return $mail->Send();
	}
}
