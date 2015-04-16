<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password="123"; // Mysql password 
$db_name="clr";
$tbl_name ="sendmail";



function template($templatename)
{
  
global $host;
global $username;
global $password;
global $db_name;
global $tbl_name;

mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$tempname = stripslashes($templatename);
$tempname = mysql_real_escape_string($tempname);
$data= array();
	$sql="SELECT * FROM $tbl_name WHERE templatename='$tempname' and sent='0'";

			$result=mysql_query($sql);
			while ($row = mysql_fetch_array($result)) {
			
			$data[]= array("name"=>$row['name'],"email"=>$row['email'],"templatename"=>$row['templatename'],"id"=>$row['id']);
				
	}
mysql_close();
	
return $data;
}
// Mysql_num_row is counting table row
function update($id,$email){
global $host;
global $username;
global $password;
global $db_name;
global $tbl_name;
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$updatesql= "UPDATE sendmail set sent ='1' where email ='$email' and id ='$id'";
echo $updatesql;
if(mysql_query($updatesql)){
	echo "record updated successfully";
	return 1;
}
else
{
	return 0;
}
}

?>