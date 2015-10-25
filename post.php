<?php

$server="localhost";
$username = "root";
$password="natsul123";
$database="frestan";
$connection = mysql_connect($server, $username, $password);

//if($connection) {
	//if the connection was successfull
$db_connection = mysql_select_db($database,$connection);
	
if($db_connection) {
		//if database is connected
		//echo "database connected";
		
		
		/*create a tabel called message to save the message*/
/*
		$sql = "CREATE TABLE messages
		(ID int(7) NOT NULL auto_increment,
		 time varchar(50) NOT NULL, 		
		 user varchar(50) NOT NULL,
		 message varchar(200) NOT NULL,
		 PRIMARY KEY(ID)
		 )";
		$create_table = mysql_query($sql);
		if($create_table){
			//echo "table created";
	}else {
		mysql_error();}
	//function check
	function help() {
		echo"you have no problem";}
		help();
*/	
function record_message() {			
		/*Record the message to the database*/	
		
		$u = addslashes($u/*$_POST['name']*/);		
		$b = addslashes($_POST['usermsg']);		
		$sql = "INSERT INTO message(user, message)
						VALUES ('$u', '$b')";
	
		$result = mysql_query($sql);	
			
		if($result){
			
			include("index.php");	
		}
		else{
			echo"sorry cannot be done";
		}
		}
	
			
record_message();


	
}else {
	echo "not connected";
	}

mysql_close($connection);
?>