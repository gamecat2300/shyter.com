<?php
	global $con;
	$con = mysqli_connect("localhost","root","root","shyter");

	// Check connection
	if (mysqli_connect_errno())
	{
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
?>