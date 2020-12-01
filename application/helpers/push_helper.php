<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('sendPush'))
{
	function sendPush($apiKey = '', $to = '', $title = '', $body = '', $idPush = 0, $idProducto = 0)
	{
        $url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array (
						  'to' => $to,
						  'notification' => 
							  array (
								'title' => $title,
								'body' => $body,
								'sound' => 'default',
								"click_action" => 'FCM_PLUGIN_ACTIVITY',
								'icon' => 'fcm_push_icon',
								'color' => 'black'
							  ),
						  'data' => 
							  array (
										'idProducto' => $idProducto,
										'idPush' 	 => $idPush
									)
						);
        $fields = json_encode ( $fields );
    
        $headers = array ("Authorization: key=" . $apiKey, "Content-Type: application/json" );
    
        $ch = curl_init();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );

        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );    
        $result = curl_exec ( $ch );
        curl_close ( $ch );
        return json_decode($result, true);
	}
}