<?php 

namespace classes;

use stdClass;


class MyToken {

	private static $key = 'I9sl44t0IqxPS27T5t5g5gD3ZF1iITxQYKWi42T9';

	
	public static function setToken($pData=[])
	{
		$header  = [
			'typ' => 'JWT',
			'alg' => 'HS256'
		];
		$header = json_encode($header); 
		$header = static::base64url_encode($header);

		$payload = [
			'sub'  => '1', //id usuario
			'name' => 'User Teste',
			'role' => '1', //permissao usuario
		];
		$payload = array_merge($payload, $pData);
		$payload = json_encode($payload);
		$payload = static::base64url_encode($payload); 

		$signature = hash_hmac('sha256', "$header.$payload", self::$key, true);
		$signature = static::base64url_encode($signature);
		
		return "$header.$payload.$signature";
	}



	public static function getToken($token){
		
		$result = false;

		$token = trim(str_replace(['Bearer', ' '], '', $token));
		
		if(!empty($token)){

			$isValid = false;
			$payload = [];
			
			$part = explode(".", $token);
			if(count($part) == 3)
			{
				$header_payload = $part[0].'.'.$part[1];
				$signature = $part[2];
				$payload   = json_decode(static::base64url_decode($part[1]));

				$valid = hash_hmac('sha256', "$header_payload", self::$key, true);
				$valid = static::base64url_encode($valid);

				if($signature == $valid){
					$isValid = true;
				}
			}
		}

		$result = new stdClass();
		$result->isValid = $isValid;
		$result->payload = $payload;

		return $result;
	}	



	private static function base64url_encode($string){
        return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
    }
 
    private static function base64url_decode($string){
        return base64_decode(str_replace(['-','_'], ['+','/'], $string));
    }

}