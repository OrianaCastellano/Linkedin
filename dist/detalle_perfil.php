<!doctype html>
<?php
	include_once "connect.php"; 
	session_start();
	$cod_p=($_GET['cod_p']);
	$sql = "SELECT cod_per,pais_per,rese_per,proy_per,exp_per,educ_per,hab_per,rec_per,prem_per, int_per, idiom_per, cod_user FROM perfiles WHERE cod_per = '$cod_p'";
	$result = mysqli_query($db,$sql);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$pais_per=$row["pais_per"];
	$rese_per=$row["rese_per"];
	$proy_per=$row["proy_per"];
	$exp_per=$row["exp_per"];
	$educ_per=$row["educ_per"];
	$hab_per=$row["hab_per"];
	$rec_per=$row["rec_per"];
	$prem_per=$row["prem_per"];
	$int_per=$row["int_per"];
	$idiom_per=$row["idiom_per"];
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
    <title>Detalles</title>
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
			<a class="header-brand row ml-1" href="perfil.php" >
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
                  <h3 class="card-title">Detalles de mi Perfil</h3>
                </div>
                <div class="card-body">
                    <form  method="post" role="form" enctype="multipart/form-data" id="formulario" onsubmit="return ced_validacion(this)">
                Pais: <br/>
                <div class="input-group mb-3">
                    <input type="text" name="pais" value="<?php echo $pais_per ?>" class="form-control" required onclick="this.select()"/>
                </div>   
				Reseña: <br/>
                <div class="input-group mb-3">
                    <input type="text" name="resena" value="<?php echo $rese_per ?>" class="form-control" required onclick="this.select()" />
                </div> 
                Proyectos: <br/>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $proy_per ?>" required name="proy" />
                </div>    
                Experiencia laboral: <br/>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="<?php echo $exp_per ?>" required name="exp" />
                </div>
				Educación: <br/>
				 <div class="input-group mb-3">
                  <input type="text"  name="educ" value="<?php echo $educ_per ?>" class="form-control" ><br>
                </div>
				Habilidades: <br/>
                <div class="input-group mb-3">
                  <input type="text"  name="habi" value="<?php echo $hab_per ?>" class="form-control" ><br>
                </div>
                Recomendación: <br/>
                <div class="input-group mb-3">
                  <input type="text" name="recom" value="<?php echo $rec_per ?>" class="form-control" ><br>
                </div>
				Premios: <br/>
                <div class="input-group mb-3">
                  <input type="text"  name="prem" value="<?php echo $prem_per ?>" class="form-control" ><br>
                </div>
				Intereses: <br/>
                <div class="input-group mb-3">
                  <input type="text"  name="interes" value="<?php echo $int_per ?>" class="form-control" ><br>
                </div>
				Idioma: <br/>
                <div class="input-group mb-3">
                  <input type="text" name="idio" value="<?php echo $idiom_per ?>" class="form-control" ><br>
                </div>
                <br />	
            </form>
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
            
		</div>
	  </div>
	</div>
	  </div>
      <footer class="footer mt-3">
      </footer>
    </div>
  </body>
</html>