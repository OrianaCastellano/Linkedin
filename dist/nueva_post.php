<!doctype html>
<?php
	include_once "connect.php"; 
	session_start();
	$id_user=$_SESSION['cod_user'];
	
if(isset($_POST["agg_publ"])){
		 
		$ruta="demo/photos";
		$archivo=$_FILES['img_post']["tmp_name"];
		$archivo;
		$nombreArchivo=$_FILES['img_post']["name"];
		$nombreArchivo;
		move_uploaded_file($archivo,$ruta."/".$nombreArchivo);
		$ruta=$ruta."/".$nombreArchivo;
		if($ruta == ''){
			$ruta=$ruta."0";
		}
		$cod_post=0;
		$id_user=$_SESSION['cod_user'];
		$tit_post="";
		$det_post=$_POST["det_post"];
		date_default_timezone_set('America/Caracas');
		$fech_post=date("Y-m-d H:i:s");
		
		$sql="INSERT INTO post(cod_post,tit_post,det_post,fech_post,cod_user,img_post) VALUES (?,?,?,?,?,?)";
		$stm=$conexion->prepare($sql);
		$stm->bind_param('isssis',$cod_post,$tit_post,$det_post,$fech_post,$id_user,$ruta);
		if($stm->execute()){
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
		  
		  		<form  id="form" method="post" role="form" enctype="multipart/form-data" class="form-horizontal">
		  			<div class="col-md-12"><br>
						<a   href="inicio.php" style="color:red"><i class="fe fe-x"></i>  </a>
						<a class="ml-3  h4">Compartir Publicación</a>
					<div style="background: white" class="mt-3">
						<div class="form-group mt-1">
                          <div class="input-group">
								  <input type="text" class="form-control" id="det_post" name="det_post" placeholder="Ingrese el tema del que quiere hablar">
								  <input type="text" name="eidp" style="display:none" id="eidp" value=""/> 
								<span class="input-group-append">
								<button type="submit"  name="agg_publ" id="agg_publ"  class="btn btn-primary">Publicar</button>
								</span>
                          </div>
                        </div>
					  <div>
						  <div class="ml-1 mt-2 mb-2">
							¿Agregar foto?
						  </div>
						 <div class="p-4">
							<div class="input-group mb-3">                    
								<input type="file" name="img_post" accept="image/*" class="btn btn-primary"  />
							</div>
						  </div>
					  </div>
					</div>
						  
				</div>
		  		</form><br>
		  	 </div>
		
		
      <footer class="footer mt-3">
      </footer>
    </div>
  </body>
</html>