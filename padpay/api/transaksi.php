<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:*');
// header('Content-Type:application/json');
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require("config/database.php");
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWK.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");

use Firebase\JWT\JWT;
// $ = $_SESSION["jwt"];
// //$jwt2 = $JWT::decode($jwt, $key,  array('JWT','HS256'));

// var_dump($jwt);

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
$role = $decoded["role"];
$idjwt = $decoded["id"];

if($data["email"] != $emailjwt || $id != $idjwt){
	$arr=['token salah'];
	echo json_encode($arr);
	die;
}

//var_dump($decoded);

$query="select * from users where id=$id";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$pengirim = $row["telp"];

$telp = $data["tujuan"];

$query2="select * from users where telp= $telp";
$result2=mysqli_query($conn,$query2);
$rows = mysqli_fetch_array($result2);

$saldo =$row["saldo"] - $data["jumlah"];
$saldo2 =$rows["saldo"] + $data["jumlah"];
// var_dump($saldo);
// die;

// $set='';
// foreach ($data as $key => $value) {
// 	if($key == "saldo"){
// 		$set.=$key."='".$value."',";
// 		var_dump($value);
// 	}
// 	//$set.=$key."='".$value."',";
// }

// $set=substr($set, 0,-1);
if($role === "admin"){
	$query="select id from users where id=$id";
	$updatequery="update users set saldo=$saldo where id=$id";

	$result=mysqli_query($conn,$query);
	$countrow=mysqli_num_rows($result);

	$myarray=array();

	if($countrow>0)
	{
		$result=mysqli_query($conn,$updatequery);
		$arr=['msg'=>'Record Update Successfully','status'=>200];
		echo json_encode($arr);
	}
	elseif($countrow<0)
	{
		$arr=['msg'=>'No Record Found','status'=>400];
		echo json_encode($arr);
	}

	//transfer
	$query="select id from users where telp=$telp";
	$updatequery="update users set saldo=$saldo2 where telp=$telp";

	$result=mysqli_query($conn,$query);
	$countrow=mysqli_num_rows($result);

	$myarray=array();

	if($countrow>0)
	{
		$result=mysqli_query($conn,$updatequery);
		$arr=['msg'=>'Record Update Successfully','status'=>200];
		echo json_encode($arr);
	}
	elseif($countrow<0)
	{
		$arr=['msg'=>'No Record Found','status'=>400];
		echo json_encode($arr);
	}

	$jumlah = $data["jumlah"];
	//masukkin ke history
	$query1="insert into transaksi set 
			pengirim='$pengirim',penerima='$telp', jumlah=$jumlah";

	$result1=mysqli_query($conn,$query1);
	if($result1)
	{
		http_response_code(200);
		$arr=['msg'=>'Record Insert Successfully','status'=>200];
		echo json_encode($arr);
	}
	else
	{
		http_response_code(401);
		$arr=['msg'=>'Record Not Inserted','status'=>400];
		echo json_encode($arr);
	}

}else{
	$arr=['msg'=>'Fail Transfer','status'=>400];
	echo json_encode($arr);
}

?>