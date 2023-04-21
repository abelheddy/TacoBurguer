<?php
include('Menu.php');
?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="../css/Estilos_tablas.css" type="text/css">
</head>
<center>

	<body>
		<div class="contenido">
			<div class="container">
				<form action="../Modelo/Editar_Usuario.php" method="POST">
					<table>
						<div class="ContBtn2">
							<h1>Tabla Usuarios</h1>
						</div>
						<thead>
							<tr class='row100 head'>
								<th>ID</th>
								<th>
									<center>NOMBRE</center>
								</th>
								<th>
									<center>PASSWORD</center>
								</th>
								<th>
									<center>NIVEL</center>
								</th>
								<th>
									<center>EDITAR</center>
								</th>
								<th>

								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							require('../Modelo/Conexion.php');
							require('../Modelo/ModeloBurger.php');
							$result = json_decode(Consultar('usuario', 'order by id_Usuario'), true);
							if ($result['status'] == 'success') {
								foreach ($result['data'] as $crow) {
							?>
									<tr class='row100'>
										<td style='width:10px'>
											<center> <?php echo $crow['id_Usuario']; ?> </center>
										</td>
										<td>
											<center><?php echo $crow['nombre']; ?> </center>
										</td>
										<td>
											<center><?php echo $crow['password']; ?></center>
										</td>
										<td>
											<center><?php echo $crow['nivel']; ?></center>
										</td>
										<td>
											<a class="btnEd" href="../Modelo/Editar_Usuario.php?EDITAR_ID=<?php echo $crow['id_Usuario']; ?>">Editar</a>
										</td>
										<td>
											<a class="btnEl" href="../Modelo/Editar_Usuario.php?ELIMINAR_ID=<?php echo $crow['id_Usuario']; ?>">Eliminar</a>
										</td>
									</tr>
							<?php
								}
							} else {
								echo "Error: " . $result['message'];
							}
							?>
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</body>
</center>

</html>