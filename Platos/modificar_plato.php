<?php
$conexion = mysqli_connect("localhost", "root", "", "restaurante_italiano")
    or die("No se puede conectar a la base de datos");

$mensaje = "";

/* ===================== ELIMINAR ===================== */
if (isset($_POST['eliminar'])) {

    $id = $_POST['eliminar'];

    $sqlEliminar = "DELETE FROM plato WHERE id_plato=$id";
    $resultado = mysqli_query($conexion, $sqlEliminar);

    if ($resultado) {
        $mensaje = "<p style='color:green; text-align:center;'>Plato eliminado correctamente.</p>";
    } else {
        $mensaje = "<p style='color:red; text-align:center;'>Error al eliminar el plato.</p>";
    }
}

/* ===================== ACTUALIZAR ===================== */
if (isset($_POST['Actualizar'])) {

    $id = $_POST['id_plato'];
    $nombre = $_POST['Nombre'];
    $descripcion = $_POST['Descripcion'];
    $precio = $_POST['Precio'];

    $sqlActualizar = "UPDATE plato SET 
                        nombre='$nombre',
                        descripcion='$descripcion',
                        precio='$precio'
                      WHERE id_plato=$id";

    mysqli_query($conexion, $sqlActualizar);

    $mensaje = "<p style='color:green; text-align:center;'>Plato actualizado correctamente.</p>";
}

/* ===================== MOSTRAR FORMULARIO DE MODIFICACIÓN ===================== */
if (isset($_POST['id_producto'])) {

    $id = $_POST['id_producto'];
    $res = mysqli_query($conexion, "SELECT * FROM plato WHERE id_plato=$id");
    $filaModificar = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="estilo.css">
<title>Modificar Plato</title>
</head>

<body>

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



<div id="formulario">
    <h1>Modificar Plato</h1>

    <form action="" method="post">
        <input type="hidden" name="id_plato" value="<?php echo $filaModificar['id_plato']; ?>">

        <label>Nombre:</label>
        <input type="text" name="Nombre" value="<?php echo $filaModificar['nombre']; ?>" required>

        <label>Descripción:</label>
        <input type="text" name="Descripcion" value="<?php echo $filaModificar['descripcion']; ?>" required>

        <label>Precio:</label>
        <input type="number" step="0.01" name="Precio" value="<?php echo $filaModificar['precio']; ?>" required>

        <input type="submit" name="Actualizar" value="Actualizar">
    </form>
</div>

</body>
</html>

<?php
} else {

/* ===================== MOSTRAR TABLA ===================== */

$consulta = mysqli_query($conexion, "SELECT * FROM plato");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="estilo.css">
<title>Administrar Platos</title>
</head>

<body>

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

<div class="contenedor-botones-superior">
        <a href="../Productos/MenuAlmacen.php" class="boton-menu" >Menu Almacén</a>
        <a href="platos.php" id="boton_aniadir" >Añadir Plato</a>
        
</div>

<?php echo $mensaje; ?>

<table>
<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Precio</th>
    <th>Acciones</th>
</tr>

<?php
while ($fila = mysqli_fetch_assoc($consulta)) {
    echo "<tr>
            <td>{$fila['id_plato']}</td>
            <td>{$fila['nombre']}</td>
            <td>{$fila['descripcion']}</td>
            <td>{$fila['precio']} €</td>
            <td>
                <form method='post'>
                    <button type='submit' name='id_producto' value='{$fila['id_plato']}'>
                        Modificar
                    </button>
                    <button type='submit' name='eliminar' value='{$fila['id_plato']}'
                        onclick=\"return confirm('¿Seguro que deseas eliminar este plato?');\">
                        Eliminar
                    </button>
                </form>
            </td>
          </tr>";
}
?>

</table>



</body>
</html>

<?php
}

mysqli_close($conexion);
?>