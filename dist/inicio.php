<!doctype html>
<?php
	include_once "connect.php"; 
	session_start();
	$id_user=$_SESSION['cod_user'];
	$array_cod_pub= array();
	$array_tiemp_pub= array();
	$array_nom_publi= array();
	$array_img_publi = array();
	$array_img_post = array();
	$array_txt_post = array();
	$array_reac_post = array();
	$array_cod_up = array();

	$sqla = "select p.tit_post, u.nombre, if(TIMESTAMPDIFF(MINUTE,p.fech_post,now())>60,if(TIMESTAMPDIFF(MINUTE,p.fech_post,now())>1440,concat(format(TIMESTAMPDIFF(MINUTE,p.fech_post,now())/1440,0),' dias'),concat(format(TIMESTAMPDIFF(MINUTE,p.fech_post,now())/60,0),' horas')),CONCAT(format(TIMESTAMPDIFF(MINUTE,p.fech_post,now()),0),' minutos')) 
	as fecha_p,(SELECT count(re.cod_reac) from reacciones as re where re.cod_post=p.cod_post)cant_reac,p.det_post,p.img_post,u.img_user,p.cod_post,u.apellido,u.cod_user from post as p, usuario as u where p.cod_user in (SELECT cod_env FROM connects where cod_rec='$id_user' and cod_inv=2
	UNION SELECT cod_rec FROM connects where cod_env='$id_user' and cod_inv=2 union select '$id_user') and u.cod_user=p.cod_user ORDER BY p.fech_post DESC";

	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		array_push($array_cod_pub, $rowa[7]);
		array_push($array_tiemp_pub, $rowa[2]);
		array_push($array_nom_publi, $rowa[1]." ".$rowa[8]);
		array_push($array_img_publi, $rowa[6]);
		array_push($array_img_post, $rowa[5]);
		array_push($array_txt_post, $rowa[4]);
		array_push($array_reac_post, $rowa[3]);
		array_push($array_cod_up, $rowa[9]);
	}
	$cant_post=sizeof($array_cod_pub);
	if(isset($_POST["mod_com"])){
			//Se obtienen los datos enviados por el usuario para modificar la publicacion
			$img_ant=$_POST["img_ant"];
			$ruta="demo/photos";
			$archivo=$_FILES['img_post']["tmp_name"];
			$archivo;
			$nombreArchivo=$_FILES['img_post']["name"];
			$nombreArchivo;
			move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
			$ruta=$ruta."/".$nombreArchivo;
			if($ruta == 'demo/photos/'){
				$ruta=$img_ant;
			}
			$cod_p=$_POST["codp"];
			$edit_cp=$_POST["detp"];
			$queryUpdate = "UPDATE post SET det_post = '$edit_cp', img_post='$ruta' WHERE cod_post = '$cod_p'";
			$resultUpdate = mysqli_query($conexion, $queryUpdate); 
			if($resultUpdate){
				header("location: inicio.php");
			}
		}
	else if(isset($_POST["elm_com"])){
		//Se obtienen los datos enviados por el usuario para modificar el comentario
		$cod_p=$_POST["codp"];
		$sql="delete from post where cod_post = '$cod_p'";
		$resultUpdate = mysqli_query($conexion, $sql); 
		if($resultUpdate){
			header("location: inicio.php");
		}
    }
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-06 16:27:42 +0200 -->
    <title>Verificacion de cuenta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>
	 <script type="text/javascript" src="./assets/js/jquery-3.1.1.js"></script>
	  <script type="text/javascript" src="app.js"></script>
	   <script type="text/javascript" src="./assets/js/customp.js"></script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand row" >
				  <div class="ml-2">
				  	<span class="avatar "  style="background-image: url(./<?php echo $_SESSION['img_user']; ?>)"></span> 
				  </div>
				  <div class="mt-2 ml-2">
				  	<?php echo $_SESSION['nombres']; ?>
				  </div>
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="header-toggler-icon"></span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <a class="dropdown-item" href="perfil.php">
                      <i class="dropdown-icon fe fe-settings"></i> Mi Perfil
                    </a>
                    <a class="dropdown-item" href="connects.php">
                      <i class="dropdown-icon fe fe-users"></i> Connects
                    </a>
					  <a class="dropdown-item" href="nueva_post.php">
                      <i class="dropdown-icon fe fe-plus-circle"></i> Publicar
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.php">
                      <i class="dropdown-icon fe fe-log-out"></i> Cerrar Sesión
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
			<?php
			for($i=0;$i<$cant_post;$i++){
				?>
		  		<form action="" id="form">
		  			<div class="col-md-12">
					<div style="background: white" class="mt-3">
					  <div class="row">
						  <div class="mt-2 ml-3">
							<h3><span class="avatar"  style="background-image: url(./<?php echo $array_img_publi[$i]; ?>)"></span></h3>
						  </div>
						<div class="tit_tarjeta ml-3">
							<div class="detalle_tarjeta">
								<strong><?php echo $array_nom_publi[$i]; ?></strong>
							</div>
							<div class="detalle_tarjeta">
								<a ><?php echo $array_tiemp_pub[$i]; ?></a>
							</div>
						</div>
						  <?php
								if($array_cod_up[$i]==$id_user){
									?>
										<div class="detalle_tarjeta">
											<button type="button" class="btn btn-white editarpost btn-sm" value="<?php echo $array_cod_pub[$i]; ?>"><i class="fe fe-settings"></i></button>
										</div>
									<?php
								}
							?>
					  </div>
					  <div>
						  <div class="ml-1">
							  <span id="comtxt<?php echo $array_cod_pub[$i]; ?>"><?php echo $array_txt_post[$i]; ?></span>
							  <span style="display:none" id="img<?php echo $array_cod_pub[$i]; ?>"><?php echo $array_img_post[$i]; ?></span>
						  </div>
						  <?php
							 if($array_img_post[$i]!="demo/photos/"){
								 ?>
						  		<div align="center">
								<img class="mt-2" src="<?php echo $array_img_post[$i]; ?>" >
							  </div>
						  		<?php 
						  }
						?>
						  
					  </div>
						<div class="mt-2 ml-2 row">
							<i class="fe fe-thumbs-up">&nbsp;</i>  <?php echo $array_reac_post[$i]; ?>
						</div>
						<div class="dropdown-divider"></div>
							<span id="codpost<?php echo $array_cod_pub[$i]; ?>" style="display:none" ><?php echo $array_cod_pub[$i]; ?></span>
							<span id="iduser<?php echo $array_cod_pub[$i]; ?>" style="display:none" ><?php echo $id_user; ?></span>
							
						<button type="button"  class="btn btn-white envio_reac" href="#" style="color:black" value="<?php echo $array_cod_pub[$i]; ?>"><i class="fe fe-thumbs-up"></i> Reaccionar </button>
						
						  <a class="btn " href="comentar_post.php?id_post=<?php echo $array_cod_pub[$i]; ?>" style="color:black"><i class="fa fa-commenting-o"></i> Comentar</a>
					</div>
				</div>
		  		</form>
		  		<?php
			}
		  if($cant_post==0){
			 ?>
		  		<div class="col-md-6 col-lg-4 mt-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Sin Publicaciones :(</h3>
                  </div>
                  <div class="card-body o-auto " align="center" style="height: 15rem">
					  <h3 class="card-title">Empieza  a invitar a nuevos contactos desde connect</h3>
					  <a href="connects.php">Empezar ></a>
                  </div>
                </div>
              </div>
		  	<?php
		  }
		  	?>
          </div>
		
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Has Revisado todo por el momento 
            </div>
          </div>
        </div>
      </footer>
    </div>
	  <div class="modal fade" id="editarp" tabindex="-1" role="dialog" aria-labelledby="modal_prest" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
            <h5 class="h3 mb-0 text-gray-800" id="exampleModalLongTitle">Acciones para su publicación</h5>
          </div>
			<div class="modal-body">
				<form  method="post" role="form" enctype="multipart/form-data" id="formulario" onsubmit="return ced_validacion(this)" class="form-horizontal">
					<div class="card-block">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Publicación</label>
						<div class="col-sm-10">
							<input type="text" id="detp" name="detp" class="form-control">
						</div>
					</div>
						<div>
						  <div class="ml-1 mt-2 mb-2">
							¿Remplazar foto?
						  </div>
						 <div class="p-4">
							<div class="input-group mb-3">                    
								<input type="file" name="img_post" accept="image/*" class="btn btn-primary"  />
							</div>
						  </div>
					  </div>
						<input type="text" name="codp" style="display:none" id="codp"/> 
						<input style="display:none" type="text" name="img_ant" id="img_ant"/> 

					<div class="modal-footer">
						<button type="submit" name="elm_com" id="elm_com" class="btn btn-danger">Eliminar</button>
						<button type="submit"  name="mod_com" id="mod_com"  class="btn btn-primary">Guardar</button>
					</div> 
					</div>
			</form>
		</div>
	  </div>
	</div>
</div>
  </body>
</html>