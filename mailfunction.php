<?php
include("db.php");
include_once("mail.php");
$templatename = $_POST['templatename'];
$value =  template($templatename);
foreach ($value as $send){
	$email= $send['email'];
	$name= $send['name'];
	$id = $send['id'];
	$tempname = $send['templatename'];
	$val = sendmail($name,$email,$templatename);
	if($val[0]['status'] =='sent'){
		
		$res = update($id,$email);
		//var_dump($res);
	}
	else {
		echo "mail to". $email ."was not sent";
	}
}
?>