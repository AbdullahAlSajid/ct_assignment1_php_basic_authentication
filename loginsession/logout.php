<?php

	session_start();

	session_destroy();

	echo "You have been logged out <a href='index.php'>Click</a> here to return";

?>