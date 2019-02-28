<?php 

function token(){

	$key='bob-esponja';
	$header = [
	'typ' => 'JWT',
	'alg' => 'HS256'
	];

	$header = json_encode($header);
	$header = base64_encode($header);

	$payload = [

		'iss'=>'vedcasts.com.br',
		'username'=>'vedovelli',
		'email'=>'vedovelli@gmail.com'
	];

	$payload = json_encode($payload);
	$payload = base64_encode($payload);


	$signature=hash_hmac("sha256", "$header.$payload", $key, true);

	$signature = base64_encode($signature);

	$token = "$header.$payload.$signature";

	return $token;
}

$received_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ2ZWRjYXN0cy5jb20uYnIiLCJ1c2VybmFtZSI6InZlZG92ZWxsaSIsImVtYWlsIjoidmVkb3ZlbGxpQGdtYWlsLmNvbSJ9.VBWnpP29ixn243h9E5mnu76aMFNwhcpqM+6z9D6IZjI=';

if ($received_token === token()){
	echo 'siga em frente';
} else {
	echo 'suma daqui';
}


 ?>