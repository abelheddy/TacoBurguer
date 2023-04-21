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

			<table>
				<div class="ContBtn2">
					<h1>Tabla Ventas</h1>
				</div>
				<thead>
					<tr class='row100 head'>
						<th>
							<center>ID VENTA</center>
						</th>
						<th>
							<center>FECHA DE VENTA</center>
						</th>
						<th>
							<center>ID_AUXVENTA</center>
						</th>
						<th>
							<center>MONTO TOTAL</center>
						</th>
						<th>
							<center>ID USUARIO</center>
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
					$result = json_decode(Consultar('venta', 'order by id_venta'), true);
					if ($result['status'] == 'success') {
						foreach ($result['data'] as $crow) {
					?>
							<tr class='row100'>
								<td style='width:10px'>
									<center> <?php echo $crow['id_venta']; ?> </center>
								</td>
								<td>
									<center><?php echo $crow['fecha']; ?> </center>
								</td>
								<td>
									<center><?php echo $crow['id_auxventa']; ?></center>
								</td>
								<td>
									<center><?php echo $crow['monto_total']; ?></center>
								</td>
								<td>
									<center><?php echo $crow['id_Usuario']; ?></center>
								</td>

								<td>
									<a class="btnEd" href="../Modelo/Editar_Venta.php?EDITAR_ID=<?php echo $crow['id_Usuario']; ?>">Editar</a>
								</td>
								<td>
									<a class="btnEl" href="../Modelo/Editar_Venta.php?ELIMINAR_ID=<?php echo $crow['id_Usuario']; ?>">Eliminar</a>
								</td>
								</form>
							</tr>
					<?php
						}
					} else {
						echo "Error: " . $result['message'];
					}
					?>

				</tbody>
			</table>

		</div>
		</div>
		<div>
		</div>
		</div>
		</div>
	</body>
</center>

</html>