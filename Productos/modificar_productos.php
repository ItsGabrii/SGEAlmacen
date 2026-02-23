<?php
//Modificar stock productos
if(isset($_POST['agregar_stock'])){

    $id_producto = $_POST['id_producto'];
    $cantidad_producto = $_POST['cantidad_producto'];
    
    if($cantidad_producto <= 0){
        die("La cantidad a añadir debe ser mayor que 0");
    }


  // CONEXIÓN
  $conexion = mysqli_connect("localhost","root","") or die ("Error al establecer conexión con servidor de BBDD.");
  mysqli_select_db($conexion,"almacen")or die ("Error al seleccionar la BBDD");

  // SELECT para comprobar si existe el producto
  $instruccionSelect = "SELECT * FROM productos WHERE id_producto='$id_producto'";
  $consultaSelect = mysqli_query($conexion,$instruccionSelect) or die ("Error al mostrar datos.");

  $numfilas = mysqli_num_rows($consultaSelect);
  if($numfilas == 1){

    // UPDATE A LA BBDD (sumamos stock)
    $instruccionUpdate = "UPDATE productos SET
      cantidad = cantidad + $cantidad_producto
      WHERE id_producto='$id_producto'";
    
    $consultaUpdate = mysqli_query($conexion,$instruccionUpdate) or die ("Error al lanzar update de datos.");

    $instruccionSelect = "SELECT * FROM productos WHERE id_producto='$id_producto'";
    $consultaSelect = mysqli_query($conexion,$instruccionSelect) or die ("Error al mostrar registro actualizado. ");
?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos_productos.css">
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

        <h2>STOCK ACTUALIZADO CORRECTAMENTE</h2>
        
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>ID Producto</th>
                    <th>Cod. Proveedor</th>
                    <th>Nombre</th>
                    <th>Cantidad Actual</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila = mysqli_fetch_array($consultaSelect)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($fila['tipo']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['id_producto']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['cod_proveedor']) . "</td>";
                    echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
                    echo "<td>" . $fila['cantidad'] . "</td>";
                    echo "<td>" . $fila['precio'] . " €</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="TablaProductos.php">Productos Almacén</a>
    </body>
    </html>
<?php 
    mysqli_close($conexion);
        
  }else{
    print("Error, ese producto no existe o no esta registrado.");
    mysqli_close($conexion);
  }
}
else {

  //Capturamos el id_producto enviado desde la tabla
  $id_producto = isset($_POST['id_producto']) ? $_POST['id_producto'] : '';

  // Formulario
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inserción de Productos</title>

  <!-- CSS EXTERNO -->
  <link rel="stylesheet" href="estilos_productos.css">
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
    <h1>Agregar stock a producto</h1>

    <form method="post">

      <label>ID Producto:</label>
      <input type="text" name="id_producto" value="<?php echo $id_producto;?>" readonly required>

      <label>Cantidad:</label>
      <input type="number" name="cantidad_producto" min="1" required >
      
      <input type="submit" name="agregar_stock" value="Agregar stock">
      
    </form>
  </div>

</body>
</html>
<?php 
} 
?>
