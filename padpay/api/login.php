<?php
//session_start();

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

require('config/database.php');
require("phpjwt/src/BeforeValidException.php");
require("phpjwt/src/ExpiredException.php");
require("phpjwt/src/JWK.php");
require("phpjwt/src/JWT.php");
require("phpjwt/src/SignatureInvalidException.php");
use Firebase\JWT\JWT;

$data=json_decode(file_get_contents("php://input"), true);

$email = $data['email'];
$password = $data['password'];
$query = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $query);
$countrow = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if($countrow > 0){
    if($password === $row['password']){

        $key="123hahaha";
        $payload = array(
                "id"=>$row['id'],
                "name"=>$row['name'],
                "email"=>$row['email'],
                "role"=>$row['role']
        );

        $jwt = JWT::encode($payload, $key);
        // $_SESSION["jwt"] = $jwt;

        $myarray["name"] = $row['name'];
        $myarray["email"] = $row['email'];
        $myarray["jwt"] = $jwt;

        $arr=['msg'=>'Login Successfully','status'=>200,'Data'=>$myarray];
    }else{
        $arr=['msg'=>'Login Unsuccessfully','status'=>200,'Data'=>null];
    }
    echo json_encode($arr);
}else{
    $arr = ['msg' => 'No Record Found', 'status'=>400];
    echo json_encode($arr);
}


?>