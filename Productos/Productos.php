<?php

if (isset($_POST['nuevo_producto'])) {
  $tipo_producto = $_POST['tipo_producto'];
  $id_producto = $_POST['id_producto'];
  $codigo_proveedor = $_POST['codigo_proveedor'];
  $nombreProducto = $_POST['nombre_producto'];
  $cantidad_producto = $_POST['cantidad_producto'];
  $precio_producto = $_POST['precio_producto'];

  // CONEXIÓN
  $conexion = mysqli_connect("localhost","root","") or die ("Error al establecer conexión con servidor de BBDD.");
  mysqli_select_db($conexion,"almacen")or die ("Error al seleccionar la BBDD");

  // INSERT A LA BBDD 
  $instruccionInsert = "INSERT INTO productos(tipo, id_producto, cod_proveedor, nombre, cantidad, precio)
                        VALUES ('$tipo_producto', '$id_producto', '$codigo_proveedor', '$nombreProducto', '$cantidad_producto','$precio_producto')";
  $consultaInsert = mysqli_query($conexion,$instruccionInsert) or die ("Error al insertar datos.");

  // SELECT MOSTRAR EL INSERT 
  $instruccionSelect = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
  $consultaSelect = mysqli_query($conexion,$instruccionSelect) or die ("Error al mostrar datos.");

  $numfilas = mysqli_num_rows($consultaSelect);
  if($numfilas == 1){
        print "<h2>PRODUCTO NUEVO AÑADIDO AL ALMACÉN: </h2>";
        print "<table border='1'>";
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
        <a href="mostrar_almacen.php">Productos Almacén</a>
<?php      
    }else{
        print "No se ha insertado el nuevo producto correctamente.";
    }
    mysqli_close($conexion);

}
elseif(isset($_POST['agregar_stock'])){

  $tipo_producto = $_POST['tipo_producto'];
  $id_producto = $_POST['id_producto'];
  $codigo_proveedor = $_POST['codigo_proveedor'];
  $nombreProducto = $_POST['nombre_producto'];
  $cantidad_producto = $_POST['cantidad_producto'];
  $precio_producto = $_POST['precio_producto'];
  
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
      tipo = '$tipo_producto',
      cod_proveedor = '$codigo_proveedor',
      nombre = '$nombreProducto',
      cantidad = cantidad + $cantidad_producto,
      precio = '$precio_producto'
      WHERE id_producto='$id_producto'";
    
    $consultaUpdate = mysqli_query($conexion,$instruccionUpdate) or die ("Error al lanzar update de datos.");

    $instruccionSelect = "SELECT * FROM productos WHERE id_producto='$id_producto'";
    $consultaSelect = mysqli_query($conexion,$instruccionSelect) or die ("Error al mostrar registro actualizado. ");

        print "<h2>PRODUCTO MODIFICADO CORRECTAMENTE: </h2>";
        print "<table border='1'>";
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
        mysqli_close($conexion);

  }else{
    print("Error, ese producto no existe o no esta registrado.");
    mysqli_close($conexion);
  }
}
else {
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
    <h1>Inserción de productos</h1>

    <form method="post">
      <div class="radio-group">
        <label>Tipo de producto:</label><br><br>
        <input type="radio" name="tipo_producto" value="ingrediente" required > Ingredientes &nbsp&nbsp&nbsp&nbsp 
        <input type="radio" name="tipo_producto" value="otros" required> Otros
      </div>

      <label>ID Producto:</label>
      <input type="text" name="id_producto" required maxlength="6">

      <label>Código Proveedor:</label>
      <input type="text" name="codigo_proveedor" required maxlength="6">

      <label>Nombre:</label>
      <input type="text" name="nombre_producto" required maxlength="20">

      <label>Cantidad:</label>
      <input type="number" name="cantidad_producto" min="1" required >
      
      <label>Precio:</label>
      <input type="number" name="precio_producto" required >

      <input type="submit" name="agregar_stock" value="Modificar Producto">
      <input type="submit" name="nuevo_producto" value="Nuevo Producto">

    </form>
  </div>

</body>
</html>
<?php 
} 
?>
