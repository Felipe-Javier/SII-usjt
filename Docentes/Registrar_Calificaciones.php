<?php
	session_start();
    if (!isset($_SESSION['active'])) {
        header('location: ../Login/Iniciar_Sesion.php');
    } else {
        if ($_SESSION['Rol'] != 'DOCENTE') {
            header('location: ../Login/Iniciar_Sesion.php');
        }
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SII</title>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"/>
	    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/css/jquery-confirm.css" integrity="sha256-rNsB/Blv2R973jYmX5UeZ9gY3mn1s1l+mjLL8AysROI=" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
	    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
	    <link rel="stylesheet" type="text/css" href="css/styles_registrar_calificaciones.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	    <script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/dist/jquery-confirm.min.js" integrity="sha256-ofvu/Oqhm74vuZGlfF1/b4OUWkK/fzlVlAWxkgHr+S4=" crossorigin="anonymous"></script>
		<link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
		<script src="js/registrar_calificaciones.js"></script>
	</head>
	<body>
		<?php
			$inicio = "";
	        $registrar_calificaciones = "active";

	        include("incluir/header.php");
	        include("incluir/navbar.php");
	    ?>
		<div class="container-fluid" id="contenido-barra" >
	  		<div class="row pt-3 pb-3" id="barra">
	    		<div class="col text-left">
	    			<span class="text-bold">Docente: 
	    				<span id="datos-usuario" class="text-nobold" IdUsuario="<?php echo $_SESSION['IdUsuario'] ?>" 
						  IdPersona="<?php echo $_SESSION['IdPersona'] ?>" IdInstructor="<?php echo $_SESSION['IdInstructor'] ?>">
	    					<?php echo $_SESSION['Empledo'] ?>
	    				</span>
	    			</span>
	    		</div>
	    		<div class="col text-right">
					<span class="text-bold">Grupo:</span>
	    		</div>
				<div class="mr-2">
					<select name="" id="grupos" class="custom-select custom-select-sm">
						<option value="" selected="true" disabled>-- Seleccione --</option>
					</select>
				</div>
	  		</div>
		</div>
	    <div class="container-fluid mt-3" id="contenido-cuerpo">
	    	<div class="row">
				<div class="col-sm-3">
					<div class="modal-content">
						<div class="text-center grupos-ciclos">GRUPOS</div>
						<nav class="sidebar card py-2 mb-4 ">
							<ul class="nav flex-column"  id="">
								<li class="nav-item has-submenu">
									<a class="ciclos nav-link"> 2020  </a>
									<ul class="submenu collapse">
										<li class="nav-item has-submenu">
											<a class="nav-link">Enero - Abril </a>
											<ul class="submenu collapse">
												<li class="nav-item">
													<a class="nav-link" id="" href="#" >Grupo1 </a>
												</li>
												<li class="nav-item ">
													<a class="nav-link" id="" href="#">Grupo2 </a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="" href="#">Grupo3 </a>
												</li>
											</ul>
										</li>
										<li class="nav-item has-submenu">
											<a class="nav-link" href="#">Mayo - Agosto </a>
											<ul class="submenu collapse">
												<li><a class="nav-link" id="" href="#" >Grupo 1 </a></li>
												<li><a class="nav-link" id="" href="#" >Grupo2 </a></li>
												<li><a class="nav-link" id="" href="#" >Grupo3 </a></li>
											</ul>
										</li>
									</ul>
								</li>
								<li class="nav-item has-submenu">
									<a class="ciclos nav-link" href="#"> 2021  </a>
									<ul class="submenu collapse">
										<li class="nav-item has-submenu">
											<a class="nav-link" href="#">Enero - Abril </a>
											<ul class="submenu collapse">
												<li><a class="nav-link" href="#">Grupo 1 </a></li>
											</ul>
										</li>
										<li class="nav-item has-submenu">
											<a class="nav-link" href="#">Mayo - Agosto </a>
											<ul class="submenu collapse">
												<li><a class="nav-link" href="#">Grupo 1 </a></li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>  
				
	    		<div class="col-sm-9">
	    			<div class="modal-content" id="result">
	    				<p class="msj text-center">selecciona un grupo</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<script> 
	document.addEventListener("DOMContentLoaded", function(){
		document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
			
			element.addEventListener('click', function (e) {
				let nextEl = element.nextElementSibling;
				let parentEl  = element.parentElement;	

				if(nextEl) {
					e.preventDefault();	
					let mycollapse = new bootstrap.Collapse(nextEl);
					
					if(nextEl.classList.contains('show')){
						$('.nav-item .nav-item .nav-item a').removeClass('active');
						mycollapse.hide();
					} else {
						mycollapse.show();
						// find other submenus with class=show
						var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
						// if it exists, then close all of them
						if(opened_submenu){
							$('.nav-item .nav-item .nav-item a').removeClass('active');
							new bootstrap.Collapse(opened_submenu);
						}
					}
				}
			}); // addEventListener
		}) // forEach
	});

	$('ul .nav-link').click(function() {
		/*$('.nav-item .nav-item .nav-item').css('background-color', '#fff');
		$('.nav-item .nav-item .nav-item').css('color', '#17202A');
		$('.nav-item .nav-item .nav-item a').css('background-color', '#fff');
		$('.nav-item .nav-item .nav-item a').css('color', '#17202A');
		$(this).css('background-color', '#0064a7');
		$(this).css('color', '#fff');*/
		$('.nav-item .nav-link').removeClass('selected');
		$(this).addClass('selected');
	});

</script>