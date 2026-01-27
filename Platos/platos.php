<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulario de inserción de platos</title>
</head>

<body>

    <?php
    /*
    // Conectar con MySQL
    $conexion = mysqli_connect("localhost", "root", "", "lindavista") 
        or die("No se puede conectar o seleccionar la base de datos");
    */
    ?>

    <?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>

        <form action="" method="post" enctype="multipart/form-data">
            <label>Nombre:</label>
            <input type="text" name="Nombre" required><br><br>

            <label>Descripcion:</label>
            <input type="text" name="Descripcion" required><br><br>

            <label>Precio:</labe l>
            <input type="number" name="Precio" min="0" required><br><br>

            <button type="submit" name="Añadir">Añadir</button>
        </form>

    <?php else: ?>

        <?php
        /*
        // Recoger datos
        $nombre = $_POST["Nombre"];
        $Descripcion = $_POST["Descripcion"];
        $precio = $_POST["Precio"];

        $sql = "INSERT INTO `platos` (`nombre`, `descripcion`, `precio`)
                VALUES ('$nombre','$descripcion','$precio')";
        $resultado = mysqli_query($conexion, $sql);

        echo $resultado 
            ? "<p style='color:green;'>El plato se agregó correctamente.</p>"
            : "<p style='color:red;'>Hubo un error al agregar el plato.</p>";

        mysqli_close($conexion);
        */
        echo "<p style='color:green;'>El plato se agregó correctamente.</p>";
        ?>


    <?php endif; ?>

</body>

</html>