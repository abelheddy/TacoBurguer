<?php include('Menu.php'); ?>
<!DOCTYPE html>
<html>

<head>
	<title>Ventas de platillos</title>
	<link rel="stylesheet" href="../css/Estilos_tablas.css" type="text/css">
</head>

<body>

	<form action="../Modelo/procesar_venta.php" method="POST">
		
		<div class="ContBtn">
			<h1>Taco Burger</h1>
			<label>Se recibio:</label>
			<br>
			<input type="text" name="cambio"><br>
			<button type="submit" name="enVenta">Finalizar compra</button>
			<button type="submit" name="Cancelar">Cancelar compra</button>
		</div>
		<div class="ContTable">
			<table>
				<tr>
					<th>Platillo</th>
					<th>Costo</th>
					<th>Cantidad</th>
				</tr>
				<?php
				// Conexión a la base de datos
				include('../Modelo/ModeloBurger.php');
				// Consulta a la tabla de platillos
				$resultado = json_decode(Consultar('platillo', ''), true);
				// Recorremos los resultados y mostramos los platillos en la tabla
				if ($resultado['status'] == 'success') {
					foreach ($resultado['data'] as $fila) {
						echo "<tr>";
						echo "<td>" . $fila['platillo'] . "</td>";
						echo "<td>" . $fila['costo'] . "</td>";
						echo "<td><input type='number' name='cantidad[" . $fila['id_platillo'] . "]'></td>";
						echo "</tr>";
					}
				}
				?>
			</table>
		</div>
	</form>
</body>

</html>