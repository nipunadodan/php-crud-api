<?php
$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['username']){
	echo json_encode([
	    'status' => 'success',
	    'message' => 'Successfully logged in',
	    'user' => [
	    	'username' => $data['username'],
		'first_name' => 'Nipuna',
		'last_name' => 'Dodantenna',
		'level' => '10',
		'status' => '5',
	    ]
	]);
}else{
	echo '{"code":401, "message": "Username not received"}';
}
