<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');


require("config/database.php");
$id=trim($_SERVER['PATH_INFO'],'/');

$query="select id from users where id=$id";
$deletequery="delete from users where id=$id";

$result=mysqli_query($conn,$query);
$countrow=mysqli_num_rows($result);

$myarray=array();

if($countrow>0)
{
	$result=mysqli_query($conn,$deletequery);
	$arr=['msg'=>'Record delete Successfully','status'=>200];
	echo json_encode($arr);
}
elseif($countrow<0)
{
	$arr=['msg'=>'No Record Found','status'=>400];
	echo json_encode($arr);
}

?>