<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');


require("config/database.php");

$data=json_decode(file_get_contents("php://input"),true);

$name=$data['name'];
$email=$data['email'];
$password=/*password_hash(*/$data['password'];/*, PASSWORD_BCRYPT);*/
$telp=$data['telp'];


$query="insert into users set 
name='$name',email='$email',password='$password',telp='$telp', role='user', saldo = 0";

$result=mysqli_query($conn,$query);

if($result)
{
	http_response_code(200);
	$arr=['msg'=>'Record Insert Successfully'];
	echo json_encode($arr);
}
else
{
	http_response_code(401);
	$arr=['msg'=>'Record Not Inserted'];
	echo json_encode($arr);
}

?>