<!doctype html>
<?php
	include_once "connect.php"; 
	session_start();
	$id_user=$_SESSION['cod_user'];
	$id_post=($_GET['id_post']);
	//Para Ver las publicaciones
	//Se crean los arreglos que contendran informacion de la publicacion
	$array_cod_pub= array();
	$array_tiemp_pub= array();
	$array_nom_publi= array();
	$array_img_publi = array();
	$array_img_post = array();
	$array_txt_post = array();
	$array_reac_post = array();
	//consulta a la base sobre tal publicacion segun su id de post
	$sqla = "select p.tit_post, u.nombre, if(TIMESTAMPDIFF(MINUTE,p.fech_post,now())>60,if(TIMESTAMPDIFF(MINUTE,p.fech_post,now())>1440,concat(format(TIMESTAMPDIFF(MINUTE,p.fech_post,now())/1440,0),' dias'),concat(format(TIMESTAMPDIFF(MINUTE,p.fech_post,now())/60,0),' horas')),CONCAT(format(TIMESTAMPDIFF(MINUTE,p.fech_post,now()),0),' minutos')) 
	as fecha_p,(SELECT count(re.cod_reac) from reacciones as re where re.cod_post=p.cod_post)cant_reac,p.det_post,p.img_post,u.img_user,p.cod_post,u.apellido from post as p, usuario as u where p.cod_user in (SELECT cod_env FROM connects where cod_rec='$id_user' and cod_inv=2
	UNION SELECT cod_rec FROM connects where cod_env='$id_user' and cod_inv=2 union select '$id_user') and u.cod_user=p.cod_user and p.cod_post='$id_post'";
	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		//Llenado de los arreglos con informaciond e cada Post
		array_push($array_cod_pub, $rowa[7]);
		array_push($array_tiemp_pub, $rowa[2]);
		array_push($array_nom_publi, $rowa[1]." ".$rowa[8]);
		array_push($array_img_publi, $rowa[6]);
		array_push($array_img_post, $rowa[5]);
		array_push($array_txt_post, $rowa[4]);
		array_push($array_reac_post, $rowa[3]);
	}
	$cant_post=sizeof($array_cod_pub);
	
	//creacion de arreglos para copmentarios
	$array_cod_com= array();
	$array_desc_com= array();
	$array_nom_comen= array();
	$array_img_comen= array();
	$array_cod_uc= array();
	//consulta  a la base por 
	$sqclc="select c.cod_com, c.desc_com, u.nombre, u.apellido, u.img_user, c.cod_user from comentarios as c, usuario as u where cod_post='$id_post' and c.cod_user=u.cod_user";
	$resultSetc = mysqli_query($conexion, $sqclc);
	while ($rowc = mysqli_fetch_row($resultSetc)) {
		//Llenado de los arreglos con informaciond e cada Post
		array_push($array_cod_com, $rowc[0]);
		array_push($array_desc_com, $rowc[1]);
		array_push($array_nom_comen, $rowc[2]." ".$rowc[3]);
		array_push($array_img_comen, $rowc[4]);
		array_push($array_cod_uc, $rowc[5]);
	}
	$cant_com=sizeof($array_cod_com);
	//Captura cuando se presione el boton de guardar
	if(isset($_POST["mod_com"])){
		//Se obtienen los datos enviados por el usuario para modificar el comentario
		$cod_com=$_POST["eidc"];
		$edit_com=$_POST["ecom"];
		$queryUpdate = "UPDATE comentarios SET desc_com = '$edit_com' WHERE cod_com = '$cod_com'";
		$resultUpdate = mysqli_query($conexion, $queryUpdate); 
		if($resultUpdate){
			header("location: comentar_post.php?id_post=".$id_post);
		}
    }
	else if(isset($_POST["elm_com"])){
		//Se obtienen los datos enviados por el usuario para modificar el comentario
		$cod_com=$_POST["eidc"];
		$sql="delete from comentarios where cod_com = '$cod_com'";
		$resultUpdate = mysqli_query($conexion, $sql); 
		if($resultUpdate){
			header("location: comentar_post.php?id_post=".$id_post);
		}
    }
	else if(isset($_POST["agg_post"])){
		//Se obtienen los datos enviados por el usuario para modificar el comentario
		$com_post=$_POST["come_agg"];
		$id_user=$_SESSION['cod_user'];
		$id_poste=$_POST["eidp"];
		$cod_pos=0;
		$sql="INSERT INTO comentarios(cod_com,desc_com,cod_post,cod_user) VALUES (?,?,?,?)";
		$stm=$conexion->prepare($sql);
		$stm->bind_param('isii',$cod_pos,$com_post,$id_poste,$id_user);
		if($stm->execute()){
			header("location: comentar_post.php?id_post=".$id_post);
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
    <title>Publicación</title>
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
	  <script type="text/javascript" src="./assets/js/custom.js"></script>

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
			<a class="header-brand row ml-1" href="inicio.php" >
				<img src="./assets/icons/atr.png" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
				  <div class="mt-2 ml-2">
				  	<?php echo $_SESSION['nombres']; ?>
				  </div>
                <div class="ml-2">
				  	<span class="avatar "  style="background-image: url(./<?php echo $_SESSION['img_user'] ?>)"></span> 
				  </div>
              </div>
            </div>
          </div>
        </div>
			<?php
			for($i=0;$i<$cant_post;$i++){
				?>
		  		<form  id="form" method="post" role="form" enctype="multipart/form-data" class="form-horizontal">
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
					  </div>
					  <div>
						  <div class="ml-1">
							<?php echo $array_txt_post[$i]; ?>
						  </div>
						 <div align="center">
							<img class="mt-2" src="<?php echo $array_img_post[$i]; ?>" >
						  </div>
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
						  <div class="form-group mt-1">
                          <div class="input-group">
								  <input type="text" class="form-control" id="come_agg" name="come_agg" placeholder="Deja aqui tu comentario">
								  <input type="text" name="eidp" style="display:none" id="eidp" value="<?php echo $id_post; ?>"/> 
								<span class="input-group-append">
								<button type="submit"  name="agg_post" id="agg_post"  class="btn btn-primary">Publicar</button>
								</span>
                          </div>
                        </div>
				</div>
		  		</form><br>
		  	<?php
			}
		  	?>
		  	<a class="ml-3 mt-5 h4">Comentarios</a>
		  	<div class="col-md-12">
				<?php
				for($i=0;$i<$cant_com;$i++){
					?>
					<div class="card mt-2">
					  <div class="card-header">
						  <div class="row" style="background: white" class="mt-3">
						  <div class="mt-2 ml-3">
							<h3><span class="avatar"  style="background-image: url(./<?php echo $array_img_comen[$i]; ?>)"></span></h3>
						  </div>
							<div class="tit_tarjeta ml-3 mt-3">
								<div class="detalle_tarjeta">
									<strong><?php echo $array_nom_comen[$i]; ?></strong>
								</div>
								<?php
									if($array_cod_uc[$i]==$id_user){
										?>
											<div class="detalle_tarjeta">
												<button type="button" class="btn btn-white editarcom btn-sm" value="<?php echo $array_cod_com[$i]; ?>"><i class="fe fe-settings"></i></button>
											</div>
										<?php
									}
								?>
							</div>
					  </div>
					  </div>
					  <div class="card-body">
						  <span id="comtxt<?php echo $array_cod_com[$i]; ?>"><?php echo $array_desc_com[$i]; ?></span>
					  </div>
					</div>
				<?php
				}
				if($cant_com==0){
					?>
					<br><a class="ml-3 mt-5 h6">Se el primero en comentar</a><br>
					<?php
				}
				?>
		  </div>
          </div>
		
		
      <footer class="footer mt-3">
      </footer>
    </div>
	  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="modal_prest" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
            <h5 class="h3 mb-0 text-gray-800" id="exampleModalLongTitle">Acciones para su comentario</h5>
          </div>
			<div class="modal-body">
				<form  method="post" role="form" enctype="multipart/form-data" id="formulario" onsubmit="return ced_validacion(this)" class="form-horizontal">
					<div class="card-block">
					<div class="form-group row">
						<label class="col-sm-2 col-form-label">Comentario</label>
						<div class="col-sm-10">
							<input type="text" id="ecom" name="ecom" class="form-control">
						</div>
					</div>

						<input type="text" name="eidc" style="display:none" id="eidc"/> 

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