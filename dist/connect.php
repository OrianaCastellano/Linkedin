<?php
    $db_host="localhost";
    $db_user="root";
    $db_pass="";
    $db_database="red_social";

    $mysqli = new mysqli($db_host,$db_user,$db_pass,$db_database); 
    $conn = mysqli_connect($db_host, $db_user, $db_pass , $db_database) or die($conn);
    $db = mysqli_connect($db_host,$db_user,$db_pass,$db_database);
	$conexion=mysqli_connect($db_host,$db_user,$db_pass,$db_database);
        if(mysqli_connect_errno()){
            echo 'Conexion Fallida : ', mysqli_connect_error();
            exit();
        }