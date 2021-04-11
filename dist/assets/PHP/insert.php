<?php
$idp=$_POST["idp"];
$idu=$_POST["idu"];
require("Connection.php");

$sql = "SELECT count(*) as cr FROM reacciones WHERE cod_user = '$idu' and cod_post='$idp'";
$result = mysqli_query($connection,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$ver_reac=$row["cr"];
if($ver_reac>=1){
	$sql="delete from reacciones where cod_user = '$idu' and cod_post='$idp'";
    mysqli_query($connection,$sql);
}else{
	$sql="INSERT INTO reacciones(cod_user, cod_post) VALUES ('$idu','$idp')";
	mysqli_query($connection,$sql);
}
?>