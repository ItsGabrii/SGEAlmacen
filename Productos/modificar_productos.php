<?php

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

        print "<h2>STOCK ACTUALIZADO CORRECTAMENTE: </h2>";
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
    <h1>Agregar Stock a Producto</h1>

    <form method="post">

      <label>ID Producto:</label>
      <input type="text" name="id_producto"  maxlength="6" required>

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
