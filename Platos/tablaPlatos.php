<?php
$conexion = mysqli_connect("localhost", "root", "", "base_datos_dam")
    or die("No se puede conectar o seleccionar la base de datos");

$consulta = "SELECT * FROM plato";
$resultadoConsulta = mysqli_query($conexion, $consulta);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="estilo.css">
    <title>Formulario de inserción de platos</title>
</head>

<body>

<!-- ===================== HEADER ===================== -->
<header>
    <div class="header-container">
        <a href="index.html">
            <div class="logo">
                <div class="logo-icon">🍝</div>
                <span>Trattoria Bella Italia</span>
            </div>
        </a>
    </div>
</header>

<!-- ===================== TABLA ===================== -->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
    </tr>

    <?php 
        while ($fila = mysqli_fetch_assoc($resultadoConsulta)) {
            echo "<tr>";
            echo "<td>" . $fila['id_plato'] . "</td>";
            echo "<td>" . $fila['nombre'] . "</td>";
            echo "<td>" . $fila['descripcion'] . "</td>";
            echo "<td>" . $fila['precio'] . "</td>";
            echo "</tr>";
        }
    ?>

</table>

<form action="index.html" method="post">
    <button type="submit">Volver al formulario</button>
    <button type="submit">Ver tabla</button>
</form>

</body>
</html>

<?php
mysqli_close($conexion);
?>
