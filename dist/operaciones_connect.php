<?php
	include_once "connect.php"; 
	session_start();
	$id_user=$_SESSION['cod_user'];
	$tipo_operacion=($_GET['oper']);
	$cod_opr=($_GET['id']);
	
	if($tipo_operacion=="aceptar"){
		$acep_inv=2;
		$queryUpdate = "UPDATE connects SET cod_inv = '$acep_inv' WHERE cod_env = '$cod_opr' and cod_rec = '$id_user'";
		$resultUpdate = mysqli_query($conexion, $queryUpdate); 
		if($resultUpdate){
			header("location: connects.php");
		}
	}
	else if($tipo_operacion=="eliminar"){
		$sql="delete from connects where cod_env = '$cod_opr' and cod_rec = '$id_user'";
		$resultUpdate = mysqli_query($conexion, $sql); 
		if($resultUpdate){
			header("location: connects.php");
		}
	}
	else if($tipo_operacion=="invitar"){
		$cod_conn=0;
			$inv_env=1;
			$sql="INSERT INTO connects(cod_con,cod_inv,cod_env,cod_rec) VALUES (?,?,?,?)";
			$stm=$conexion->prepare($sql);
			$stm->bind_param('iiii',$cod_conn,$inv_env,$id_user,$cod_opr);
			if($stm->execute()){
				header("location: connects.php");
			}
		
	}
?>