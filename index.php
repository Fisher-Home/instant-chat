<?php
session_start();

if(isset($_GET['logout'])){	
	
	//Simple exit message
	$fp = fopen("log.html", 'a');
	fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
	fclose($fp);
	
	session_destroy();
	header("Location: index.php"); //Redirect the user
}

function loginForm(){
	echo'
	<h1 align="center">Smart Chat</h1>
	<div id="loginform">
	<form action="index.php" method="POST">
		<p>Please enter your name to continue:</p>
		<label for="name">Name:</label>
		<input type="text" name="name" id="name" />
		<input type="submit" name="enter" id="enter" value="Enter" />
	</form>
	</div>
	';
}
if(isset($_POST['enter'])){
	if($_POST['name'] != ""){
		$_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
	}
	else{
		echo '<span class="error">Please type in a name</span>';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Chat - Customer Module</title>
<link type="text/css" rel="stylesheet" href="style.css" />
</head>

<?php
if(!isset($_SESSION['name'])){
	loginForm();
}
else{
?>
<div id="wrapper">
	<div id="menu">
		<p class="welcome">Welcome, <?php $u = $_POST['name'] ;?><b>
		
		<?php echo $_SESSION['name']; ?></b></p>
		<p class="logout"><form method="GET" action=""><input name="logout" type="submit"  id="logout" value="Exit" /></form></p>
		<div style="clear:both"></div>
	</div>	
	<div id="chatbox">

	<?php
	/*Read the message from the database*/
function read_msg(){		
		$sql = "SELECT * FROM message";
		$result = mysql_query($sql);
		
			while($sql_field=mysql_fetch_assoc($result)) {
				print "<p> ".date('h:s')." ".$sql_field['user'].":";
				print $sql_field['message']."</p>";
				//print "done";
			}
		}
read_msg();
		/*if(file_exists("log.html") && filesize("log.html") > 0){
		$handle = fopen("log.html", "r");
		$contents = fread($handle, filesize("log.html"));
		fclose($handle);
		
		echo $contents;
	}*/
	?></div>
	
	<form name="message" action="post.php" method="POST">
		<?php $u = $_SESSION['name'] ;?>
		<input name="usermsg" type="text" id="usermsg" size="63" />
		<input name="submitmsg" type="submit"  id="submitmsg" value="Send" />
	</form>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
/* jQuery Document
$(document).ready(function(){
	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("#", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
		$.ajax({
			url: "post.php",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div				
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20;
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
	setInterval (loadLog, 2500);	//Reload file every 2.5 seconds
	
	//If user wants to end session
	$("#exit").click(function(){
		var exit = confirm("Are you sure you want to end the session?");
		if(exit==true){window.location = 'index.php?logout=true';}		
	});
});
</script>
<?php

$b = $_POST['usermsg'];
}
?>
</body>
</html>