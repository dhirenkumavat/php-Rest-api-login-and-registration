<?php
header('Content-type: application/json');
include_once('config.php');
$json;

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['login_id']) || empty($_POST['password'])){
		setError("empty param !!!");
	}else{
		$login_id = $_POST['login_id'];
        $password = $_POST['password'];
        $strQueryTeachers = "SELECT * FROM `user` WHERE `email` = '$login_id' OR `mobile` = '$login_id'";
		$result = mysqli_query($con,$strQueryTeachers);
if ($result->num_rows>0) {
			$row = $result->fetch_assoc();
			if ($row['password'] == $password) {
				$row["user_type"] ="user";
				respond($row,"user");
			}else{
				setError("You have entered wrong password.");
			}
		
    }else{
        setError("data not found");
    }
}
}else{
	setError("Method must be POST.");
}

function respond($row,$user_type){
	global $json;
	//$row = $result->fetch_assoc();
	$json=array("status" => true, "msg" => "Success","user_type"=>$user_type,"user"=>$row);
}

function setError($error){
	global $json;
	$json=array("status" => false, "msg" => $error);
}



echo json_encode($json);
?>