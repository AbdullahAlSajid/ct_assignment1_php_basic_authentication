<?php

	 error_reporting(0);

	echo "<h1>Register</h1>";	
	$submit = $_POST['submit'];
	$fullname = strip_tags($_POST['fullname']);
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);
	$repeatpassword = strip_tags($_POST['repeatpassword']);
	$date = date("Y-m-d");
	if($submit)
	{
		$server = "localhost";
		$user = "root";
		$pass = "";
		$dbName = "phplogin";

		$connect = mysqli_connect($server , $user , $pass , $dbName) or die("Couldn't Connect");

		$name_check_sql = "select username from users where username='$username'";
		$name_check_result = mysqli_query($connect, $name_check_sql);
		$name_check_count = mysqli_num_rows($name_check_result);

		if($name_check_count!=0)
		{
			die("Username already taken!");
		}
		if ($username&&$fullname&&$password&&$repeatpassword)
		{

			if($password==$repeatpassword)
			{
				if(strlen($username)>25||strlen($fullname)>25)
				{
					echo "Max limit for username/fullname are 25 characters";
				}
				else
				{
					if(strlen($password)>25 || strlen($password)<3)
					{
						echo "Password must be between 3 and 25 characters";
					}
					else
					{

						$password = md5($password);
						$repeatpassword = md5($repeatpassword);

						$server = "localhost";
						$user = "root";
						$pass = "";
						$dbName = "phplogin";

						$connect = mysqli_connect($server , $user , $pass , $dbName) or die("Couldn't Connect");

						$sql = "insert into users values('','$fullname','$date','$username','$password')";

						$result = mysqli_query($connect, $sql);

						die('You have been registered!! <a href="index.php">Return to login page</a>');
					}
				}
			}
			else
				echo "Your password doesn't match!!";
		}
		else
			echo "Please fill in <b>all</b> fields!";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="register.php" method="POST">
		<table>
			<tr>
				<td>
					Your full name : 
				</td>
				<td>
					<input type="text" name="fullname">
				</td>
			</tr>
			<tr>
				<td>
					Choose username : 
				</td>
				<td>
					<input type="text" name="username">
				</td>
			</tr>
			<tr>
				<td>
					Choose a password : 
				</td>
				<td>
					<input type="password" name="password">
				</td>
			</tr>
			<tr>
				<td>
					Repeat your password : 
				</td>
				<td>
					<input type="password" name="repeatpassword">
				</td>
			</tr>
		</table>
		<p>
			<input type="submit" name="submit" value="Register">
		</p>
	</form>
</body>
</html>