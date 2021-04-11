<!doctype html>

<?php
	//Se llama al archivo que contiene las credenciales apra el acceso a la BD
	include("connect.php");
	session_start();
	//Captura cuando se presione el boton de registro
	if(isset($_POST["btn_regi"])){
		//Se obtienen los datos enviados por el usuario para su registro
		$email_reg=$_POST["email"];
		$nom=$_POST["nom"];
		$ape=$_POST["ape"];
		$pass=$_POST["pass"];
		$num=$_POST["num"];
		$cod_est=2;
		$cod_reg_u=0;
		$img_def="demo/faces/img/defect.png";
		//Verificacion dentro de la base que no exista repeticion de correo ni de numero celular
		$sql = "SELECT count(*) as count_c from usuario where correo='$email_reg'";
		$result = mysqli_query($conexion,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$reptc=$row['count_c'];
		$sql = "SELECT count(*) as count_c from usuario where numero='$num'";
		$result = mysqli_query($conexion,$sql);
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		$reptn=$row['count_c'];
		if($reptn>=1 || $reptc>=1){
			?>
				<div >
						<label for="tab-1" class="tab">El numero o correo ya se encuentra registrado</label><br>
					</div>
            <?php
		}else{
			//Se insertan los datos en la base
			$sql="INSERT INTO usuario(cod_user,nombre,apellido,correo,clave,cod_est,numero,img_user) VALUES (?,?,?,?,?,?,?,?)";
			$stm=$conexion->prepare($sql);
			$stm->bind_param('issssiss',$cod_reg_u,$nom,$ape,$email_reg,$pass,$cod_est,$num,$img_def);
			if($stm->execute()){
				$sql = "SELECT Max(cod_user) as cod_max from usuario";
				$result = mysqli_query($conexion,$sql);
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				$n_id=$row['cod_max'];

				require 'PHPMailer/PHPMailerAutoload.php';

				//Create a new PHPMailer instance
				$mail = new PHPMailer();
				$mail->IsSMTP();

				//Configuracion servidor mail
				$mail->From = "socialconnect.c@gmail.com"; //remitente
				$mail->FromName = 'RedSocial'; //remitente
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'tls'; //seguridad
				$mail->Host = "smtp.gmail.com"; // servidor smtp
				$mail->Port = 25; //puerto
				$mail->Username ='socialconnect.c@gmail.com'; //nombre usuario
				$mail->Password = 'Social.123'; //contraseña

				//Agregar destinatario
				$dir_web="http://192.168.1.5/redsocial/dist/";
				$valid_cuent = $dir_web.'validacion.php?key='.$n_id;
				$mail->AddAddress($email_reg);
				$mail->Subject ='RedSocial';
				$mailContent = 'Estimado(a) '.$ape.''."\n".'Bienvenido a nuestra Red Social. '."\n".'Para continuar con la validación de su cuenta, de clic en el siguiente link:'."\n".''.$valid_cuent.''."\n".'Saludos.';
				$mail->Body = $mailContent;

				$mail->CharSet = 'UTF-8';

				//Avisar si fue enviado o no y dirigir al index
				if ($mail->Send()) {
					header("location: notificacion.php");
				} else {
					?>
						<div >
								<label for="tab-1" class="tab">Error de envio, por favor Revise la direccion de correo proporcionada</label><br>
							</div>
					<?php
				}
			}
		}
    }
	//Captura del boton de inicio de sesion
	else if(isset($_POST["btn_login"])){
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			//los datos recibidos por el usuario se transforman  auna cadena SQL usando mysqli_real_escape_string
			$email = mysqli_real_escape_string($db,$_POST['email']);
			$clav = mysqli_real_escape_string($db,$_POST['password']); 
			//Genero la consulta para saber si el usuario existe
			$sql = "SELECT cod_user, cod_est, nombre, apellido, img_user, correo, numero FROM usuario WHERE correo = '$email' and clave = '$clav'";
			$result = mysqli_query($db,$sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			$_SESSION['cod_user'] =$row["cod_user"];
			$_SESSION['est_user'] =$row["cod_est"];
			$_SESSION['nombres'] =$row["nombre"]." ".$row["apellido"];
			$_SESSION['img_user'] =$row["img_user"];
			$_SESSION['num_ce'] =$row["numero"];
			$_SESSION['correo'] =$row["correo"];
			$count = mysqli_num_rows($result);
			//Si el usuario existe y ha validado su cuenta procede a su cuenta
			if($count == 1 and $_SESSION['est_user']==1) {
				header("location: inicio.php");
			}
			//Si el usuario existe pero no ha validado su cuenta
			else if($count == 1 and $_SESSION['est_user']==2) {
				header("location: notificacion.php");
			}
			else{
				?>
				<div align="center"><br>
					<div >
						<h5 class="alert alert-danger">Usuario o contraseña incorrectos</h5>
					</div>
				</div>
				<?php
			}
		}
	}
?>
<html lang="en" dir="ltr">
  	<head>
    	<meta charset="UTF-8">
		 <link href="./assets/css/style_login.css" rel="stylesheet" /> 	
		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta http-equiv="Content-Language" content="en" />
	</head>
	<body class="">
		<div class="login-wrap">
			<div class="login-html">
				<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Ingreso</label>
				<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Registro</label>
				<div class="login-form">
					<div class="sign-in-htm">
						<form id="login-form" method="post" role="form" enctype="multipart/form-data">
							<div class="group">
								<label for="user" class="label">Correo</label>
								<input id="email" name="email" type="email" class="input">
							</div>
							<div class="group">
								<label for="pass" class="label">Contraseña</label>
								<input id="password" name="password" type="password" class="input" data-type="password">
							</div><br>
							<div class="group">
								<input type="submit" id="btn_login" name="btn_login" class="button" value="Inciar Sesión">
							</div>
						</form>
					</div>
					<div class="sign-up-htm">
						<form id="login-form" method="post" role="form" enctype="multipart/form-data">
							<div class="group">
								<label for="user" class="label">Nombre</label>
								<input id="nom" name="nom" type="text" required class="input">
							</div>
							<div class="group">
								<label for="user" class="label">Apellido</label>
								<input id="ape" name="ape" type="text" required class="input">
							</div>
							<div class="group">
								<label for="pass" class="label">Contraseña</label>
								<input id="pass" name="pass" type="password" required class="input" data-type="password">
							</div>
							<div class="group">
								<label for="pass" class="label">Correo</label>
								<input id="email" name="email" type="email" required class="input">
							</div>
							<div class="group">
								<label for="pass" class="label">Numero Celular</label>
								<input id="num" name="num" type="number" required class="input">
							</div>
							<br>
							<div class="group">
								<input type="submit" class="button" id="btn_regi" name="btn_regi" value="Registrar">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>