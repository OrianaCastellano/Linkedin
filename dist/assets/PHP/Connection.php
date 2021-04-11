<?php
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_database="red_social";

	$connection=mysqli_connect($db_host,$db_user,$db_pass,$db_database);
	mysqli_set_charset($connection,"utf8")
?>