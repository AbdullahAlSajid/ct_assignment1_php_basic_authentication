<?php

	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$server = "localhost";
	$user = "root";
	$pass = "";
	$dbName = "phplogin";

	if($username && $password)
	{
		$connect = mysqli_connect($server , $user , $pass , $dbName) or die("Couldn't Connect");

		$sql = "select * from users where username ='$username'";

		$result = mysqli_query($connect, $sql);

		$count = mysqli_num_rows($result);

		if($count!=0)
		{
			while ($row = mysqli_fetch_assoc($result)) 
			{
				$dbusername = $row['username'];
				$dbpassword = $row['pass'];
			}

			if($username == $dbusername && md5($password) == $dbpassword)
			{
				echo "You're in! <a href='member.php'>Click</a> here to enter the member page";
				$_SESSION['username'] = $dbusername;
			}
			else
			{
				echo "Incorrect Password!";
			}
		}
		else
		{
			die("That usetr doesn't exist!");
		}

	}
	else
	{
		die("Please enter a username & a password!");
	}

?>