<?php
	
	ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);	

	require_once('vendor/autoload.php');
	
    //Esta classe eu já tinha pronta, mas foi feita por mim
    //Token gerado: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiIxIiwibmFtZSI6IlVzZXIgVGVzdGUiLCJyb2xlIjoiMSJ9.mpFtMLGIEHYBWeGTk9aTc5RcuDGPNFP_Y9udaFuh3-8
	use classes\MyToken;


	/**
	 * RECEBENDO A REQUISIÇÃO
	 */	
	$route = '';
    $id    = '';
	$requestMethod = $_SERVER['REQUEST_METHOD'];    

	if(!isset($_REQUEST['params'])){
		http_response_code(400);
		echo json_encode(['status'=>'Params is empty!']);
	}
	else {

        $slashes = explode('/', $_REQUEST['params']);
        $route   = isset($slashes[0]) ? $slashes[0] : '';
        $id      = isset($slashes[1]) ? $slashes[1] : '';

		//valida o token
		$headers = apache_request_headers(); 
		if(!isset($headers['Authorization'])){
			http_response_code(401);
			die(json_encode(['status'=>'Token is empty!']));
		}
		else {
			
			$getToken = MyToken::getToken($headers['Authorization']);
			
			if(!$getToken->isValid){
				http_response_code(401);
				die(json_encode(['status'=> 'Invalid token!']));
			}
		}		
		

		//inclui o arquivo da rota se ele existir
		if(!empty($route) && is_file('routes/'.$route.'.php')){
            define('INTERNAL_ACCESS', 1); //permite o acesso da rota pelo sistema
			require_once('routes/'.$route.'.php');
		}
		else {
			http_response_code(404);
			echo json_encode(['status'=>'Not found!']);
		}
	}



