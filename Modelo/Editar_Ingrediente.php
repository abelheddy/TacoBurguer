<?php
require("../Modelo/ModeloBurger.php");
require("../Vistas/Menu.php");

error_reporting(E_ERROR | E_PARSE);

// Si se recibió un ID de usuario a editar
if (!empty($_GET['EDITAR_ID'])) {
	$id = $_GET['EDITAR_ID'];
	$result = json_decode(Consultar('ingrediente', 'WHERE id_ingrediente =' . $id . ''), true);

	// Si se encontró el usuario, mostrar el formulario para editarlo
	if (!empty($result['data'][0])) {
		$row = $result['data'][0];
?>
		<!DOCTYPE html>
		<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="../css/Estilos_Inputs.css" type="text/css">
			<title>EDITAR CLIENTES</title>
			<!--======================================= ESTILO DE LA TABLA PLOMO ==============================-->
			<script language="javascript" type="text/javascript">
				function windowClose() {
					window.open('', '_parent', '');
					window.close();
				}
			</script>
		</head>

		<body>
			<div class="container">
				<form method="post" action="">
					<label>Nombre del usuario:</label>
					<div class="form-group">
						<input id="ingrediente" name="ingrediente" class="element text medium" type="text" maxlength="255" value="<?php echo $row['ingrediente']; ?>" />
					</div>
					<div class="form-group">
						<button id="saveForm" type="submit" name="enviar">EDITAR</button>
						<button class="button2" type="submit" onclick="javascript: form.action='../Vistas/ConsultaIngredientes.php';">REGRESAR</button>
					</div>
				</form>
			</div>
			<?php
			// Si se recibió un envío del formulario
			if (isset($_POST["enviar"])) {
				$ingredi = $_POST["ingrediente"];
				$res = json_decode(Actualizar("ingrediente", "ingrediente = TRIM('" . $ingredi ."')", "id_ingrediente=TRIM(" . $id . ")"),true);
				if($res['status'] == 'success'){
					echo '<script>alert("Registro Actualizado");
					window.location.href = "../Vistas/ConsultaIngredientes.php";
					</script>';
					
				}
			}
			?>
		</body>

		</html>
	<?php
	} else {
		// Si el usuario no fue encontrado, mostrar un mensaje de error
		echo "<p>El usuario con ID $id no existe.</p>";
	}
}

if (!empty($_GET['ELIMINAR_ID'])) {
	$id = $_GET['ELIMINAR_ID'];
	$result = json_decode(Consultar('ingrediente', 'WHERE id_ingrediente =' . $id . ''), true);

	// Si se encontró el usuario, mostrar el formulario para editarlo
	if (!empty($result['data'][0])) {
		$row = $result['data'][0];
	?>
		<!DOCTYPE html>
		<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<link rel="stylesheet" href="../css/Estilos_Inputs.css" type="text/css">
		</head>

		<body>
			<div class="container">
				<form method="post" action="">
					<center><label>Estas seguro que quieres eliminar el regitro:</label>
						<br><Label><?php echo $row['id_ingrediente'] . " " . $row['ingrediente'] . " "; ?></Label>
					</center>

					<div class="form-group">
						<button type="submit" name="SI">SI</button>
						<button class="button2" type="submit" onclick="javascript: form.action='../Vistas/ConsultaIngredientes.php';">NO</button>
					</div>
				</form>
			</div>
		</body>

		</html>
<?php
	} else {
		// Si el usuario no fue encontrado, mostrar un mensaje de error
		echo "<p>El usuario con ID $id no existe.</p>";
	}

	if (isset($_POST['SI'])) {
		$res = json_decode(Eliminar("ingrediente", "id_ingrediente = " . $id . ""),true);
		if($res['status'] == 'success'){
			echo '<script>alert("Campo eliminado");
			window.location.href = "../Vistas/ConsultaIngredientes.php";
			</script>';
			
		}
		exit;
	}
}
