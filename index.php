<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>
			<?php echo "smart chat"; ?>
		</title>
	</head>
	<body>
		<h1 align="center">
			Smart Chat
		</h1>
		<?php
			$username=$_POST['username'];
			$nolog="<h4 algn =\"center\"you are not logged in</h4>";
			if($username== "abc" ){
				print($username);
			}
			else {
			print($nolog);
		?>
		
		<form align ="center" name = "chat_login" action="index.php" method="post">
			<input type="text" name="username" value="enter your name"></br></br>
			<input type="text" name="password" value="enter your password"></br></br>
			<input type="submit" name= "login">
		</form>
		<?php
			}
		?>
	</body>
</html>