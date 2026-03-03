<?php
// Agregar producto nuevo
if (isset($_POST['nuevo_producto'])) {
  $tipo_producto = $_POST['tipo_producto'];
  $codigo_proveedor = $_POST['codigo_proveedor'];
  $nombreProducto = $_POST['nombre_producto'];
  $cantidad_producto = $_POST['cantidad_producto'];
  $precio_producto = $_POST['precio_producto'];

  // CONEXIÓN
  $conexion = mysqli_connect("localhost","root","") or die ("Error al establecer conexión con servidor de BBDD.");
  mysqli_select_db($conexion,"restaurante_italiano")or die ("Error al seleccionar la BBDD");

  // INSERT A LA BBDD 
  $instruccionInsert = "INSERT INTO producto(tipo, cod_proveedor, nombre, cantidad, precio)
                        VALUES ('$tipo_producto', '$codigo_proveedor', '$nombreProducto', '$cantidad_producto','$precio_producto')";
  $consultaInsert = mysqli_query($conexion,$instruccionInsert) or die ("Error al insertar datos.");

  // 3. RECUPERAMOS EL ID QUE ACABA DE GENERAR MYSQL
  $ultimo_id = mysqli_insert_id($conexion);

  // SELECT MOSTRAR EL INSERT 
  $instruccionSelect = "SELECT * FROM producto WHERE id_producto = '$ultimo_id'";
  $consultaSelect = mysqli_query($conexion,$instruccionSelect) or die ("Error al mostrar datos.");

  $numfilas = mysqli_num_rows($consultaSelect);
  if($numfilas == 1){
        print '<link rel="stylesheet" href="estilos_productos.css">';
        print "<h2>PRODUCTO AÑADIDO CORRECTAMENTE: </h2>";

        print "<table>";
            print "<tr>";
                print "<th>Tipo</th>";
                print "<th>Id_producto</th>";
                print "<th>Cod_proveedor</th>";
                print "<th>Nombre</th>";
                print "<th>Cantidad</th>";
                print "<th>Precio</th>";
            print "</tr>";

        for($i=0;$i<$numfilas;$i++){
            $fila = mysqli_fetch_array($consultaSelect);
            print "<tr>";
                print"<td>".$fila['tipo']."</td>";
                print"<td>".$fila['id_producto']."</td>";
                print"<td>".$fila['cod_proveedor']."</td>";
                print"<td>".$fila['nombre']."</td>";
                print"<td>".$fila['cantidad']."</td>";
                print"<td>".$fila['precio']."</td>";         
            print "</tr>";            
        }
        print "</table>";
       
?>
        <a href="TablaProductos.php">Ir al Almacén de Productos</a>
<?php      
    }else{
        print "No se ha insertado el nuevo producto correctamente.";
    }
    mysqli_close($conexion);

} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos</title>

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

  <div class='contenedor-botones-superior'>
  <br><a href='MenuAlmacen.php' class='boton-menu'>Menu Almacén</a>
  </div>

  <div id="formulario">
    <h1>AÑADIR NUEVOS PRODUCTOS</h1>

    <form method="post">
      <div class="radio-group">
        <label>Tipo de producto:</label><br><br>
        <input type="radio" name="tipo_producto" value="ingrediente" required > Ingredientes &nbsp&nbsp&nbsp&nbsp 
        <input type="radio" name="tipo_producto" value="otros" required> Otros
      </div>

      <label>Código Proveedor:</label>
      <input type="text" name="codigo_proveedor" required maxlength="6">

      <label>Nombre:</label>
      <input type="text" name="nombre_producto" required maxlength="20">

      <label>Cantidad:</label>
      <input type="number" name="cantidad_producto" min="1" required >
      
      <label>Precio:</label>
      <input type="number" name="precio_producto" required >

      
      <input type="submit" name="nuevo_producto" value="Nuevo Producto">

    </form>
  </div>

</body>
</html>
<?php 
} 
?>
