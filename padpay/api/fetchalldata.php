<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Credentials:true');
header('Access-Control-Allow-Methods:GET,POST,OPTIONS');
header('Access-Control-Allow-Headers:*');
header('Content-Type:application/json');


require("config/database.php");
//require("validatetoken.php");

$query="select * from users";
$result=mysqli_query($conn,$query);
$countrow=mysqli_num_rows($result);

$myarray=array();

if($countrow>0)
{
	while($row=mysqli_fetch_array($result)){			
	$records=array(
				"id"=>$row['id'],
				"name"=>$row['name'],
				"email"=>$row['email'],
				"telp"=>$row['telp'],
				"role"=>$row['role'],
				"saldo"=>$row['saldo']
			);
	array_push($myarray, $records);
	}
	
	$arr=['msg'=>'Record Fetch Successfully','status'=>200,'records'=>$myarray];
	echo json_encode($arr);
}
else
{
	$arr=['msg'=>'No Record Found','status'=>400];
	echo json_encode($arr);
}

?>