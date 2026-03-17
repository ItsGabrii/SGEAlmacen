<?php
if (isset($_POST["Enviar"])) {
    // 1. Conexión a la base de datos (asegúrate de que el nombre 'almacen' sea el correcto)
    $conexion = mysqli_connect("localhost", "root", "", "restaurante_italiano")
        or die("No se puede conectar o seleccionar la base de datos");

    // 2. Captura de datos por POST
    $nombre = $_POST["Nombre"];
    $descripcion = $_POST["Descripcion"];
    $precio = $_POST["Precio"]; // Ahora se captura directamente del input

    // 3. Inserción en la BBDD (Usando nombre_plato según tu estructura)
    $sql = "INSERT INTO plato (nombre, descripcion, precio)
            VALUES ('$nombre', '$descripcion', '$precio')";

    if (mysqli_query($conexion, $sql)) {
        header("location:modificar_plato.php");
    } else {
        echo "Error al insertar: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Añadir Plato - La Trattoria</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
         <!-- ===================== HEADER ===================== -->
  <header>
    <div class="header-container">
      <a href="index.html"><div class="logo">
        <div class="logo-icon">🍝</div>
        <span>Trattoria Bella Italia</span>
      </div>
    </a>
    </div>
  </header>

    <!-- Boton Menu Almacén-->
    <div class="contenedor-botones-superior">
        
        <a href="../Productos/MenuAlmacen.php" class="boton-menu" >Menu Almacén</a>
    </div>

    <div id="formulario">
        <h1>NUEVO PLATO</h1>
        <form method="POST">
            <label>Nombre del Plato:</label>
            <input type="text" name="Nombre" required>

            <label>Descripción:</label>
            <input type="text" name="Descripcion" required>

            <label>Precio (€):</label>
            <input type="number" name="Precio" step="0.01" min="0" required>

            <input type="submit" name="Enviar" value="Insertar Plato">
        </form>
    </div>
</body>
</html>
<?php
}
?>