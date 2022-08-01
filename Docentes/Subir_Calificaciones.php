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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet"/>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="css/styles_principal.css">
    <link rel="stylesheet" type="text/css" href="css/styles_subir_calificaciones.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
	<link rel="shortcut icon" href="../img/usjt-logo.png" type="image/x-icon">
</head>
<body>
	<?php
		$inicio = "";
        $subir_calificaciones = "active";

        include("incluir/header.php");
        include("incluir/navbar.php");
		include("config.php")
    ?>
	<div class="container-fluid" id="contenido" >
  		<div class="row pt-3 pb-3" id="barra">
    		<div class="col">
      		Panel de Inicio
    		</div>
    		<div class="col text-right pr-0">
				<span>Grupo: &nbsp;</span>
    		</div>
			<div id="filters" class="">
				<select name="" id="" >
					<option value="hide" >-- Grupo --</option>
					<option value="grupo1">grupo 1</option>
					<option value="grupo2">grupo 2</option>
					<option value="grupo3">grupo 3</option>
				</select>
			</div>
  		</div>
	</div>
    <!--<div class="container-fluid text-center" id="contenido">
    	<div class="row" id="barra">
    		<div class="col-sm-12">
    			<div class="row mt-3 mb-2">
    				<div class="col-sm-6 text-left">
    					<label class="pl-4">Panel de inicio</label>
    				</div> 
    				<div class="col-sm-6 text-right">
    					<label class="pr-4">Grupo: </label>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>-->
    <div class="container mt-3" id="contenido">
    	<div class="row">
    		<div class="col-sm-12">
    			<div class="modal-content ">
    				<h6>Lista de calificaciones</h6>
					<table class="table table-bordered text-center table-responsive" id="table-subir-cal">
					    <thead class="thead-subir-cal">
						    <tr>
							    <th class="th-td-mat">Matricula</th>
						        <th class="th-td-nom">Nombre</th>
							    <th class="th-td-p1">Parcial 1</th>
							    <th class="th-td-p2">Parcial 2</th>
							    <th class="th-td-p3">Parcial 3</th>
							</tr>
					    </thead>
						<tbody class="tbody-subir-cal">
						    <tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ismal Rodriguez Sanchez</td>
							    <td class="th-td-p1">
							      	<input type="number" min="0" max="100" class="form-control text-center" name="Cal_Par1_A1" id="Cal_Par1_A1" value="100">
									<div id="filters" style="margin-top: 5px;">
										<select name="" id="">
											<option value="ordinario">Ordinario</option>
											<option value="ex_ord">Ex. Ordinario</option>
											<option value="repeticion">Repetición</option>
											<option value="equivalencia">Equivalencia</option>
										</select>
									</div>
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" min="0" max="100" class="form-control text-center" name="Cal_Par1_A1" id="Cal_Par1_A1" value="90">
									<div id="filters" style="margin-top: 5px;">
										<select name="" id="">
											<option value="ordinario">Ordinario</option>
											<option value="ex_ord">Ex. Ordinario</option>
											<option value="repeticion">Repetición</option>
											<option value="equivalencia">Equivalencia</option>
										</select>
									</div>
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" min="0" max="100" class="form-control text-center" name="Cal_Par1_A1" id="Cal_Par1_A1" value="90">
									<div id="filters" style="margin-top: 5px;">
										<select name="" id="">
											<option value="ordinario">Ordinario</option>
											<option value="ex_ord">Ex. Ordinario</option>
											<option value="repeticion">Repetición</option>
											<option value="equivalencia">Equivalencia</option>
										</select>
									</div>
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Jonathan Jimenez Sanchez</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par2_A2" id="Cal_Par2_A2" value="50">
							    </td>
							    <td class="th-td-p2">
							     	<input type="number" class="form-control text-center" name="Cal_Par2_A2" id="Cal_Par2_A2" value="60">
							    </td>
							    <td class="th-td-p3">
							     	<input type="number" class="form-control text-center" name="Cal_Par2_A2" id="Cal_Par2_A2" value="60">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
							<tr>
							    <td class="th-td-mat">12345</td>
							    <td class="th-td-nom">Ricardo Bazan</td>
							    <td class="th-td-p1">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p2">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							    <td class="th-td-p3">
							      	<input type="number" class="form-control text-center" name="Cal_Par3_A3" id="Cal_Par3_A3" value="0">
							    </td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


<!--
	<div id="filters">
		<span>Grupos: &nbsp;</span>
		<select name="fetchval" id="fetchval">
			<option value="" disabled>seleciona grupo</option>
			<option value="grupo1">grupo 1</option>
			<option value="grupo2">grupo 2</option>
			<option value="grupo3">grupo 3</option>
		</select>
	</div>

	<div class="container" id="resultado">
		<table class="table">
			<thead>
				<tr>
					<th>matricula</th>
					<th>nombre</th>
					<th>parcial 1</th>
					<th>parcial 2</th>
					<th>parcial 3</th>
				</tr>
			</thead>
			<tbody>

				<?php

				$query = "SELECT * FROM grupo1";
				$r = mysqli_query($con, $query);
				while($row = mysqli_fetch_assoc($r)){
				?>
				<tr>
					<td><?php echo $row['p_mat']?></td>
					<td><?php echo $row['p_nombre']?></td>
					<td><?php echo $row['p_p1']?></td>
					<td><?php echo $row['p_p2']?></td>
					<td><?php echo $row['p_p3']?></td>
				</tr>
				<?php
			}
				?>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#fetchval").on('change',function(){
				var value = $(this).val();
				//alert(value);

				$.ajax({
					url:"fetch.php",
					type:"POST",
					data:{request:value},
					beforeSend:function(){
						$("#resultado").html("<span> Buscando... </span>");
					},
					success:function(data){
						$("#resultado").html(data);
					},
					error:function(data) {
						$("#resultado").html(data);
					}
				});
			});
		});
	</script> 
-->

</body>
</html>