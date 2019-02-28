<?php 

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

 ?>