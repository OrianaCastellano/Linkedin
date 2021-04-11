<!doctype html>
<?php
	include_once "connect.php"; 
	session_start();
	$id_user=$_SESSION['cod_user'];

	//recibiendo palabra clave para buscar entre mis amigos
	 if(isset($_GET['word_con'])){
		$word=($_GET['word_con']);
	}else{
		$word="";
	}
	//recibiendo palabra clave para buscar nuevos connects
	if(isset($_GET['word_con2'])){
		$word2=($_GET['word_con2']);
	}else{
		$word2="";
	}

	//declaracion de arreglos para mis amigos
	$array_codu= array();
	$array_nomu= array();
	$array_imgu = array();
	$array_email = array();
	//consulta para saber quienes son mis amigos
	$sqla = "select cod_user, nombre, apellido, img_user, correo from usuario where cod_user in (SELECT cod_env FROM connects where cod_rec='$id_user' and cod_inv=2 UNION SELECT cod_rec FROM connects where cod_env='$id_user' and cod_inv=2) and (nombre like '%$word%' or apellido like '%$word%')";
	//Ingreso de los datos d emis amigos a  los arreglos
	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		array_push($array_codu, $rowa[0]);
		array_push($array_nomu, $rowa[1]." ".$rowa[2]);
		array_push($array_imgu, $rowa[3]);
		array_push($array_email, $rowa[4]);
	}
	//cantidad de amigos
	$cant_amg=sizeof($array_codu);

	//declaracion de arreglos para quien no son mis amigos
	$array_codun= array();
	$array_nomun= array();
	$array_imgun = array();
	$array_emailn = array();
	//consulta para saber quienes no son mis amigos
	$sqla = "select cod_user, nombre, apellido, img_user, correo from usuario where cod_user not in (SELECT cod_env FROM connects where cod_rec='$id_user' UNION SELECT cod_rec FROM connects where cod_env='$id_user' ) and cod_user!='$id_user' and (nombre like '%$word2%' or apellido like '%$word2%')";
	//Ingreso de los datos d emis amigos a  los arreglos
	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		array_push($array_codun, $rowa[0]);
		array_push($array_nomun, $rowa[1]." ".$rowa[2]);
		array_push($array_imgun, $rowa[3]);
		array_push($array_emailn, $rowa[4]);
	}
	//Cantidad de personas registradas
	$cant_amgn=sizeof($array_codun);

	//declaracion de arreglos para las solicitud
	$array_cods= array();
	$array_noms= array();
	$array_imgs = array();
	$array_emails = array();
	//consulta para saber quienes me enviaron solicitud
	$sqla = "select cod_user, nombre, apellido, img_user, correo from usuario where cod_user in (SELECT cod_env FROM connects where cod_rec='$id_user' and cod_inv=1)";
	//Ingreso de los datos d emis amigos a  los arreglos
	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		array_push($array_cods, $rowa[0]);
		array_push($array_noms, $rowa[1]." ".$rowa[2]);
		array_push($array_imgs, $rowa[3]);
		array_push($array_emails, $rowa[4]);
	}
	//cantidad de amigos recibidos
	$cant_amgs=sizeof($array_cods);

	//declaracion de arreglos para las solicitud enviadas
	$array_codse= array();
	$array_nomse= array();
	$array_imgse = array();
	$array_emailse = array();
	//consulta para saber a quienes le envie solicitud
	$sqla = "select cod_user, nombre, apellido, img_user, correo from usuario where cod_user in (SELECT cod_rec FROM connects where cod_env='$id_user' and cod_inv=1)";
	//Ingreso de los datos de mis amigos a  los arreglos
	$resultSeta = mysqli_query($conexion, $sqla);
	while ($rowa = mysqli_fetch_row($resultSeta)) {
		array_push($array_codse, $rowa[0]);
		array_push($array_nomse, $rowa[1]." ".$rowa[2]);
		array_push($array_imgse, $rowa[3]);
		array_push($array_emailse, $rowa[4]);
	}
	//cantidad de amigos enviados
	$cant_amgse=sizeof($array_codse);

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
    <title>Connects</title>
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
		  
		  		<div class="col-md-6 col-lg-4 mt-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Connects</h3>
                  </div>
				  <div class="p-3">
						<form action="">
                        <div class="input-group">
						<input type="text" class="form-control form-control-sm" id="search" placeholder="Ingrese el nombre de su amigo">
                          <span class="input-group-btn ml-2">
                            <button class="btn btn-sm btn-default" onclick="busqueda()" type="button">
                              <span class="fe fe-search"></span>
                            </button>
						</span>
                        </div>
                      </form>	
				  </div>
                  <div class="card-body o-auto" style="height: 15rem">
                    <ul class="list-unstyled list-separated">
					<?php
					for($i=0;$i<$cant_amg;$i++){
						?>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
							  <span class="avatar "  style="background-image: url(./<?php echo $array_imgu[$i]; ?>)"></span> 
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit"><?php echo $array_nomu[$i]; ?></a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x"><?php echo $array_email[$i]; ?></small>
                          </div>
                        </div>
                      </li>
						<?php
						}
						//se pregunta si hay amigos mediante la cantidad recopilada por la consulta y aemas si no s einserto una palabra para la busqueda
						if($cant_amg==0 && $word==""){
							?>
							<div align="center">
								<a class="ml-3 mt-5 h6">Aun no tienes CONNECTS</a>
								<br><a class="ml-3 mt-5 h6">Invita a nuevos contactos </a>
							</div>
							<?php
						}
						//En caso de una enconrtar coincidencias arroja este resultado
						else if($cant_amg==0 && $word!=""){
							?>
							<div align="center">
								<a class="ml-3 mt-5 h6"><?php echo $word; ?></a>
								<br><a class="ml-3 mt-5 h6">La busqueda no dio resultados </a>
							</div>
							<?php
						}
						?>
                    </ul>
                  </div>
                </div>
              </div>
		  		<div class="col-md-6 col-lg-4 mt-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Contactos en la Red</h3>
                  </div>
				  <div class="p-3">
					  <form action="">
                        <div class="input-group">
						<input type="text" class="form-control form-control-sm" id="search2" placeholder="Ingrese el nombre de quien busca">
                          <span class="input-group-btn ml-2">
                            <button class="btn btn-sm btn-default" onclick="busqueda2()" type="button">
                              <span class="fe fe-search"></span>
                            </button>
						</span>
                        </div>
                      </form>
				  </div>
                  <div class="card-body o-auto" style="height: 15rem">
                    <ul class="list-unstyled list-separated">
					<?php
					for($i=0;$i<$cant_amgn;$i++){
						?>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
							  <h3><span class="avatar"  style="background-image: url(./<?php echo $array_imgun[$i]; ?>)"></span></h3>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit"><?php echo $array_nomun[$i]; ?></a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x"><?php echo $array_emailn[$i]; ?></small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="operaciones_connect.php?id=<?php echo $array_codun[$i]; ?>&oper=invitar" class="dropdown-item"><i class="dropdown-icon fe fe-user-plus"></i> Invitar </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
						<?php
						}
						//En caso de no enconrtar coincidencias arroja este resultado
						if($cant_amgn==0 && $word2!=""){
							?>
							<div align="center">
								<a class="ml-3 mt-5 h6"><?php echo $word; ?></a>
								<br><a class="ml-3 mt-5 h6">La busqueda no dio resultados </a>
							</div>
							<?php
						}
						?>
                    </ul>
                  </div>
                </div>
              </div>
		  		<div class="col-md-6 col-lg-4 mt-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Solicitudes Recibidas</h3>
                  </div>
				  <div class="p-3">	
				  </div>
                  <div class="card-body o-auto" style="height: 15rem">
                    <ul class="list-unstyled list-separated">
					<?php
					for($i=0;$i<$cant_amgs;$i++){
						?>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
							  <h3><span class="avatar"  style="background-image: url(./<?php echo $array_imgs[$i]; ?>)"></span></h3>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit"><?php echo $array_noms[$i]; ?></a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x"><?php echo $array_emails[$i]; ?></small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                              <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-vertical"></i></a>
                              <div class="dropdown-menu dropdown-menu-right">
                                <a href="operaciones_connect.php?id=<?php echo $array_cods[$i]; ?>&oper=aceptar" class="dropdown-item"><i class="dropdown-icon fe fe-check"></i> Aceptar </a>
								  <a href="operaciones_connect.php?id=<?php echo $array_cods[$i]; ?>&oper=eliminar" class="dropdown-item"><i class="dropdown-icon fe fe-x"></i> Eliminar </a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </li>
						<?php
						}
						if($cant_amgs==0){
							?>
							<div align="center">
								<a class="ml-3 mt-5 h6">Sin solicitudes</a>
								<br><a class="ml-3 mt-5 h6">Aqui recibiras las solicitud de tus connects </a>
							</div>
							<?php
						}
						?>
                    </ul>
                  </div>
                </div>
              </div>
		  <div class="col-md-6 col-lg-4 mt-5">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Solicitudes Enviadas</h3>
                  </div>
				  <div class="p-3">	
				  </div>
                  <div class="card-body o-auto" style="height: 15rem">
                    <ul class="list-unstyled list-separated">
					<?php
					for($i=0;$i<$cant_amgse;$i++){
						?>
                      <li class="list-separated-item">
                        <div class="row align-items-center">
                          <div class="col-auto">
							  <h3><span class="avatar"  style="background-image: url(./<?php echo $array_imgse[$i]; ?>)"></span></h3>
                          </div>
                          <div class="col">
                            <div>
                              <a href="javascript:void(0)" class="text-inherit"><?php echo $array_nomse[$i]; ?></a>
                            </div>
                            <small class="d-block item-except text-sm text-muted h-1x"><?php echo $array_emailse[$i]; ?></small>
                          </div>
                          <div class="col-auto">
                            <div class="item-action dropdown">
                            </div>
                          </div>
                        </div>
                      </li>
						<?php
						}
						if($cant_amgse==0){
							?>
							<div align="center">
								<a class="ml-3 mt-5 h6">Sin solicitudes enviadas</a>
								<br><a class="ml-3 mt-5 h6">Aqui apareceran las solicitud enviadas </a>
							</div>
							<?php
						}
						?>
                    </ul>
                  </div>
                </div>
              </div>
		  	 </div>
		
		
      <footer class="footer mt-3">
      </footer>
    </div>
	  <script type="text/javascript">
        function busqueda2()
        {
			var valor2 = document.getElementById("search2").value;
            var pag="connects.php?word_con2="+valor2;
            location.href=pag;
        }
    </script>
	  <script type="text/javascript">
        function busqueda()
        {
			var valor = document.getElementById("search").value;
            var pag="connects.php?word_con="+valor;
            location.href=pag;
        }
    </script>
  </body>
</html>