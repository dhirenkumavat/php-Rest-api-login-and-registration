<?php
header('Content-type: application/json');
include_once('config.php');
$json;

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['email']) || empty($_POST['password'])){
		setError("empty param !!!");
	}else{
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $strQueryTeachers = "INSERT INTO `registration`(`name`, `email`,`mobile`,`password`) VALUES ('$name','$mobile','$email','$password')";
		$result = mysqli_query($con,$strQueryTeachers);
         if ($result) {
			$json=array("status" => true, "msg" => "Data Insert");
		}else{
        setError("data not Insert");
    }
}
}else{
	setError("Method must be POST.");
}



function setError($error){
	global $json;
	$json=array("status" => false, "msg" => $error);
}



echo json_encode($json);
?>