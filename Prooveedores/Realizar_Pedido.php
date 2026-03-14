<?php
$conexion = mysqli_connect("localhost","root","") or die("No se puede conectar.");
// Seleccionamos la base de datos específica llamada 'almacen'
mysqli_select_db($conexion,"restaurante_italiano") or die("No se puede seleccionar la base de datos.");

//Si el usuario ya ha rellenado el formulario y pulsa "Enviar Pedido"
if (isset($_POST['ejecutar_update'])) {
    $id_prod = $_POST['producto_elegido'];
    $unidades = $_POST['cantidad_nueva'];

    //Actualizamos la tabla 'productos'.
    $sql_update = "UPDATE productos SET cantidad = cantidad + $unidades WHERE id_producto = '$id_prod'";
    mysqli_query($conexion, $sql_update) or die("Error al actualizar");

    // Mostramos el mensaje de éxito cargando el estilo CSS para que se vea bien
    echo "<link rel='stylesheet' href='estilo_proveedores.css'>";
    echo "<div id='formulario' style='text-align: center;'>";
    echo "<h2>¡Stock Actualizado!</h2>";
    echo "<p style='margin-bottom: 30px;'>Se han sumado las unidades correctamente.</p>";

    echo "<div class='contenedor-botones-superior'>
            <a href='Edicion_Proveedores.php' class='boton-menu'>Volver a la tabla</a>
          </div>";
    echo "</div>";
}

//Si el usuario viene de la tabla anterior
else {
    // Recogemos el ID del proveedor que nos ha llegado por el botón de la página anterior
    $id_prov = $_POST['pedir']; 
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estilo_proveedores.css">
    <title>Hacer Pedido</title>
</head>
<body>
    <div id="formulario">
        <h1>Pedido al Proveedor: 
            <?php
                // Mostramos el ID del proveedor en el título
                echo $id_prov;
            ?>
        </h1>
                
        <form method="post" action="Realizar_Pedido.php">
            
            <input type="hidden" name="proveedor_id" value="<?php echo $id_prov; ?>">

            <label>Selecciona Producto:</label>
            <select name="producto_elegido" style="width:100%; padding:10px; margin-bottom:18px;">
                <?php
                // Consultamos todos los productos de la tabla para rellenar el desplegable
                $sql_productos = "SELECT id_producto, nombre FROM productos";
                $res = mysqli_query($conexion, $sql_productos);
                
                while ($fila = mysqli_fetch_array($res)) {
                    echo "<option value='".$fila['id_producto']."'>".$fila['nombre']."</option>";
                }
                ?>
            </select>

            <label>Cantidad:</label>
            <input type="number" name="cantidad_nueva" min="1" required>

            <input type="submit" name="ejecutar_update" value="Actualizar Stock">
        </form>
    </div>
</body>
</html>
<?php 
} 
mysqli_close($conexion); 
?>

