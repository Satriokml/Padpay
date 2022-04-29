<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include('config/database.php');
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWK.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");
use Firebase\JWT\JWT;

$data=json_decode(file_get_contents("php://input"),true);

$jwt=trim($data['jwt']);
$key="123hahaha";


try {
    // decode jwt
    $decoded = JWT::decode($jwt, $key,  array('JWT','HS256'));
    http_response_code(200);
    $arr=['msg'=>'Access granted','data'=>$decoded];   
	echo json_encode($arr); 
}

// if decode fails, it means jwt is invalid
catch (Exception $e){
	http_response_code(401);
	$arr=['msg'=>'Access denied.','data'=>$e->getMessage()];
	echo json_encode($arr);
}
die;

?>