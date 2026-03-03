<?php
if (isset($_POST["Enviar"])) {
    $conexion = mysqli_connect("localhost", "root", "", "restaurante_italiano")
        or die("No se puede conectar o seleccionar la base de datos");

    $nombre = $_POST["Nombre"];
    $descripcion = $_POST["Descripcion"];
    $preciosIngredientes = [
        "tomate" => 0.50,
        "mozzarella" => 1.20,
        "albahaca" => 0.30,
        "aceite_oliva" => 0.40,
        "ajo" => 0.20,
        "cebolla" => 0.25,
        "oregano" => 0.15,
        "parmesano" => 1.50,
        "pasta" => 0.80,
        "champiñones" => 0.70
    ];

    $precioTotal = 0;

    for ($i = 1; $i <= 4; $i++) {
        $ingrediente = $_POST["Ingrediente$i"];
        $cantidad = (int)$_POST["Cantidad$i"];

        if ($cantidad > 0) {
            $precioTotal += $preciosIngredientes[$ingrediente] * $cantidad;
        }
    }

    // Insertar el plato
    $sql = "INSERT INTO plato (nombre, descripcion, precio)
            VALUES ('$nombre', '$descripcion', '$precioTotal')";
    $resultado = mysqli_query($conexion, $sql);

    // Obtener el último plato añadido
    $consulta = "SELECT * FROM plato ORDER BY id_plato DESC LIMIT 1";
    $resultadoConsulta = mysqli_query($conexion, $consulta);
    $fila = mysqli_fetch_assoc($resultadoConsulta);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <title>Plato añadido</title>
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




<?php
if ($resultado) {
    echo "<p style='color:green; text-align:center; margin-top:30px;'>El plato se agregó correctamente.</p><br><br>";
} else {
    echo "<p style='color:red; text-align:center; margin-top:30px;'>Hubo un error al agregar el plato.</p>";
}
?>



<!-- ===================== TABLA DEL ÚLTIMO PLATO ===================== -->
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Precio</th>
    </tr>
    <tr>
        <td><?php echo $fila['id_plato']; ?></td>
        <td><?php echo $fila['nombre']; ?></td>
        <td><?php echo $fila['descripcion']; ?></td>
        <td><?php echo $fila['precio']; ?> €</td>
    </tr>
</table>

<div class="contenedor-botones-superior">
    <a href="platos.php" id="boton_aniadir" >Añadir Plato</a>
   <a href="modificar_plato.php" class="boton-menu" >Ver tabla</a>
    <a href="../Productos/MenuAlmacen.php" class="boton-menu" >Menu Almacén</a>
</div>


</body>
</html>

<?php
mysqli_close($conexion);

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
    <form action="" method="post">
        <h1>Inserción de platos</h1>
        <label>Nombre:</label>
        <input type="text" name="Nombre" required><br><br>

        <label>Descripcion:</label>
        <input type="text" name="Descripcion" required><br><br>

        <label for="tipo">Ingrediente 1: </label>
        <select name ="Ingrediente1">
            <option value="tomate">Tomate</option>
            <option value="mozzarella">Mozzarella</option>
            <option value="albahaca">Albahaca</option>
            <option value="aceite_oliva">Aceite de oliva</option>
            <option value="ajo">Ajo</option>
            <option value="cebolla">Cebolla</option>
            <option value="oregano">Orégano</option>
            <option value="parmesano">Queso parmesano</option>
            <option value="pasta">Pasta</option>
            <option value="champiñones">Champiñones</option>
        </select>
         <label>Cantidad:</label>
         <input type="number" name="Cantidad1" min="0" value="0"><br><br>

        <label for="tipo">Ingrediente 2: </label>
        <select name ="Ingrediente2">
            <option value="tomate">Tomate</option>
            <option value="mozzarella">Mozzarella</option>
            <option value="albahaca">Albahaca</option>
            <option value="aceite_oliva">Aceite de oliva</option>
            <option value="ajo">Ajo</option>
            <option value="cebolla">Cebolla</option>
            <option value="oregano">Orégano</option>
            <option value="parmesano">Queso parmesano</option>
            <option value="pasta">Pasta</option>
            <option value="champiñones">Champiñones</option>
        </select>
         <label>Cantidad:</label>
         <input type="number" name="Cantidad2" min="0" value="0"><br><br>

        <label for="tipo">Ingrediente 3: </label>
        <select name ="Ingrediente3">
            <option value="tomate">Tomate</option>
            <option value="mozzarella">Mozzarella</option>
            <option value="albahaca">Albahaca</option>
            <option value="aceite_oliva">Aceite de oliva</option>
            <option value="ajo">Ajo</option>
            <option value="cebolla">Cebolla</option>
            <option value="oregano">Orégano</option>
            <option value="parmesano">Queso parmesano</option>
            <option value="pasta">Pasta</option>
            <option value="champiñones">Champiñones</option>
        </select>
         <label>Cantidad:</label>
         <input type="number" name="Cantidad3" min="0" value="0"><br><br>

        <label for="tipo">Ingrediente 4: </label>
        <select name ="Ingrediente4">
            <option value="tomate">Tomate</option>
            <option value="mozzarella">Mozzarella</option>
            <option value="albahaca">Albahaca</option>
            <option value="aceite_oliva">Aceite de oliva</option>
            <option value="ajo">Ajo</option>
            <option value="cebolla">Cebolla</option>
            <option value="oregano">Orégano</option>
            <option value="parmesano">Queso parmesano</option>
            <option value="pasta">Pasta</option>
            <option value="champiñones">Champiñones</option>
        </select>
         <label>Cantidad:</label>
         <input type="number" name="Cantidad4" min="0" value="0"><br><br>

        <input type="submit" name="Enviar"></button>
    </form>
    </div>
</body>
</html>
<?php
}
?>