<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');


require("config/database.php");
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWK.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");
// require("validatetoken.php");
use Firebase\JWT\JWT;

$id=trim($_SERVER['PATH_INFO'],'/');
$data=json_decode(file_get_contents("php://input"),true);

if(empty($data["jwt"])){
	$arr=['belum login'];
	echo json_encode($arr);
	die;
}

$jwt = trim($data['jwt']);
$key="123hahaha";
$decoded = JWT::decode($jwt, $key, array('JWT','HS256'));
$decoded = (array) $decoded;
//var_dump($decoded["name"]);
$emailjwt = $decoded["email"];
$idjwt = $decoded["id"];

if($data["email"] != $emailjwt || $id != $idjwt){
	$arr=['token salah'];
	echo json_encode($arr);
	die;
}

$query="select * from users where id='$id'";
$result=mysqli_query($conn,$query);
$countrow=mysqli_num_rows($result);

$myarray=array();

if($countrow>0)
{
	$row=mysqli_fetch_array($result);
			
	$records=array(
				"id"=>$row['id'],
				"name"=>$row['name'],
				"email"=>$row['email'],
				"telp"=>$row['telp'],
				"role"=>$row['role'],
				"saldo"=>$row['saldo']
			);
	array_push($myarray, $records);
	
	$arr=['msg'=>'Record Fetch Successfully','status'=>200,'records'=>$myarray];
	echo json_encode($arr);
}
else
{
	$arr=['msg'=>'No Record Found','status'=>400];
	echo json_encode($arr);
}

?>