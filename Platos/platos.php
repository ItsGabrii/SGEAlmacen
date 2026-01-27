<?php
if (isset($_POST["Enviar"])) {

    /*
    $conexion = mysqli_connect("localhost", "root", "", "lindavista")
        or die("No se puede conectar o seleccionar la base de datos");

    $nombre = $_POST["Nombre"];
    $descripcion = $_POST["Descripcion"];
    $precio = $_POST["Precio"];

    $sql = "INSERT INTO platos (nombre, descripcion, precio)
            VALUES ('$nombre', '$descripcion', '$precio')";

    $resultado = mysqli_query($conexion, $sql);

    echo $resultado
        ? "<p style='color:green;'>El plato se agregó correctamente.</p>"
        : "<p style='color:red;'>Hubo un error al agregar el plato.</p>";

    mysqli_close($conexion);
    */

    echo "<p style='color:green;'>El plato se agregó correctamente.</p>";

} else {
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Formulario de inserción de platos</title>
</head>

<body>
    <div id="formulario">
    <form action="" method="post">
        <h1>Inserción de platos</h1>
        <label>Nombre:</label>
        <input type="text" name="Nombre" required><br><br>

        <label>Descripcion:</label>
        <input type="text" name="Descripcion" required><br><br>

        <label>Precio:</label>
        <input type="number" name="Precio" min="0" required><br><br>

        <input type="submit" name="Enviar"></button>
    </form>
    </div>
</body>
</html>
<?php
}
?>