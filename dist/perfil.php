<!doctype html>
<?php
	include_once "connect.php"; 
	session_start();
	$id_user=$_SESSION['cod_user'];
	//captura del boton para generar un nuevo perfil
 	if(isset($_POST["agg_perf"])){
		$cod_per=0;
		$pais_per=$_POST["pais"];
		$rese_per=$_POST["resena"];
		$proy_per=$_POST["proy"];
		$exp_per=$_POST["exp"];
		$educ_per=$_POST["educ"];
		$hab_per=$_POST["habi"];
		$rec_per=$_POST["recom"];
		$prem_per=$_POST["prem"];
	 	$int_per=$_POST["interes"];
		$idiom_per=$_POST["idio"];
	 
	 	$sql="INSERT INTO perfiles(cod_per,pais_per,rese_per,proy_per,exp_per,educ_per,hab_per,rec_per,prem_per, int_per, idiom_per, cod_user) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
			$stm=$conexion->prepare($sql);
			$stm->bind_param('issssssssssi',$cod_per,$pais_per,$rese_per,$proy_per,$exp_per,$educ_per,$hab_per,$rec_per,$prem_per,$int_per,$idiom_per,$id_user);
			if($stm->execute()){
				header("location: perfil.php");
			}
     }
	//declaracion de arreglos para los perfiles
	$array_codp= array();
	$array_idiop= array();
	
	//consulta para extraer datos de los perfiles
	$sqla = "select cod_per, idiom_per from perfiles where cod_user='$id_user'";
	//Ingreso de los datos de los perfiles a los arreglos
	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		array_push($array_codp, $rowa[0]);
		array_push($array_idiop, $rowa[1]);
	}
	//cantidad de Perfiles
	$cant_perf=sizeof($array_codp);
	
	//
	if(isset($_POST["acc_fot"])){
		$ruta="demo/faces/img";
		$archivo=$_FILES['img_post']["tmp_name"];
		$archivo;
		$nombreArchivo=$_FILES['img_post']["name"];
		$nombreArchivo;
		move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
		$ruta=$ruta."/".$nombreArchivo;
		if($ruta == ''){
			$ruta=$ruta."defect.png";
		}
		
		$queryUpdate = "UPDATE usuario SET img_user = '$ruta' WHERE cod_user = '$id_user'";
		$resultUpdate = mysqli_query($conexion, $queryUpdate); 
		if($resultUpdate){
			header("location: perfil.php");
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
    <title>Mi perfil</title>
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
		  
		  <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Mi perfil</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="col-auto">
                        <span class="avatar avatar-xl" style="background-image: url(<?php echo $_SESSION['img_user']; ?>)"></span>
                      </div>
                      <div class="col">
                        <div class="form-group">
                          <label class="form-label">Email</label>
							<a><?php echo $_SESSION['correo']; ?></a>
                        </div>
                      </div>
                    </div><br>
                    <div class="form-group">
                      <label class="form-label">Nombres</label>
                      <a><?php echo $_SESSION['nombres']; ?></a>
                    </div>
					  <div class="form-group">
                      <label class="form-label">Celular</label>
                      <a><?php echo $_SESSION['num_ce']; ?></a>
                    </div>
					<form  id="form" method="post" role="form" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group">
						<label class="form-label">Actualizar foto</label>
						<div class="">
						<div class="input-group">                    
							<input type="file" name="img_post" accept="image/*" />
						</div>
					  </div>
					  </div>
					<button type="submit"  name="acc_fot" id="acc_fot"  class="btn btn-primary">Actualizar</button>
					</form>
			  	</div>
              </div>
		  		<div class="col-md-6 col-lg-4 mt-1">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Mis Perfiles </h3>
                  </div>
                  <div class="card-body o-auto" style="height: 15rem">
                    <ul class="list-unstyled list-separated">
					<?php
					for($i=0;$i<$cant_perf;$i++){
						?>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <div>
                            </div>
                            <a class="h3"><?php echo $array_idiop[$i]; ?></a>
                          </div>
                          <div class="col-auto">
							  <a href="detalle_perfil.php?cod_p=<?php echo $array_codp[$i]; ?>"><i class="dropdown-icon fe fe-eye"></i> Ver </a>
                          </div>
                        </div>
                      </li>
						<?php
						}
						if($cant_perf==0){
							?>
							<div align="center">
								<a class="ml-3 mt-5 h6">Sin Perfiles</a>
								<br><a class="ml-3 mt-5 h6">Aqui encontraras tus perfiles registrados </a>
							</div>
							<?php
						}
						?>
                    </ul>
                  </div>
					<div class="form-footer p-2">
                      <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalaggp">Agregar Perfil</button>
                    </div>
                </div>
              </div>
		  	 </div>
		
		<div class="modal fade" id="modalaggp" tabindex="-1" role="dialog" aria-labelledby="modalaggp" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
            <h5 class="h3 mb-0 text-gray-800" id="exampleModalLongTitle">Perfil En Nuevo Idioma</h5>
          </div>
			<div class="modal-body">
            <form  method="post" role="form" enctype="multipart/form-data" id="formulario" onsubmit="return ced_validacion(this)">
                Pais: <br/>
                <div class="input-group mb-3">
                    <input type="text" name="pais" class="form-control" required onclick="this.select()"/>
                </div>   
				Reseña: <br/>
                <div class="input-group mb-3">
                    <input type="text" name="resena" class="form-control" required onclick="this.select()" />
                </div> 
                Proyectos: <br/>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" required name="proy" />
                </div>    
                Experiencia laboral: <br/>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" required name="exp" />
                </div>
				Educación: <br/>
				 <div class="input-group mb-3">
                  <input type="text"  name="educ" class="form-control" ><br>
                </div>
				Habilidades: <br/>
                <div class="input-group mb-3">
                  <input type="text"  name="habi" class="form-control" ><br>
                </div>
                Recomendación: <br/>
                <div class="input-group mb-3">
                  <input type="text" name="recom" class="form-control" ><br>
                </div>
				Premios: <br/>
                <div class="input-group mb-3">
                  <input type="text"  name="prem" class="form-control" ><br>
                </div>
				Intereses: <br/>
                <div class="input-group mb-3">
                  <input type="text"  name="interes" class="form-control" ><br>
                </div>
				Idioma: <br/>
                <div class="input-group mb-3">
                  <input type="text" name="idio" class="form-control" ><br>
                </div>
                <br />	                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="agg_perf" name="agg_perf" class="btn btn-primary">Agregar</button>
                </div>
            </form>
		</div>
	  </div>
	</div>
	  </div>
      <footer class="footer mt-3">
      </footer>
    </div>
  </body>
</html>