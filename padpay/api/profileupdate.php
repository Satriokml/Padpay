<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');

require("config/database.php");

$id=$_POST['id'];
$name=$_POST['name'];
$password = $_POST['password'];
$telp=$_POST['telp'];
$email=$_POST['email'];
// $role=$_POST['role'];
// $saldo=$_POST['saldo'];


$query="update users set 
name='$name', telp='$telp', password='$password',email='$email' where id=$id";

$result=mysqli_query($conn,$query);

if($result)
{
	http_response_code(200);
	$arr=['msg'=>'Record Update Successfully'];
	echo json_encode($arr);
}
else
{
	http_response_code(401);
	$arr=['msg'=>'Record Not Update'];
	echo json_encode($arr);
}

?>