<?php
if (isset($_POST["Enviar"])) {
    $conexion = mysqli_connect("localhost", "root", "", "base_datos_dam")
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

    $sql = "INSERT INTO plato (nombre, descripcion, precio)
            VALUES ('$nombre', '$descripcion', '$precioTotal')";

    $resultado = mysqli_query($conexion, $sql);

    echo $resultado
        ? "<p style='color:green;'>El plato se agregó correctamente.</p>"
        : "<p style='color:red;'>Hubo un error al agregar el plato.</p>";

    

    $consulta = "SELECT * FROM plato";
    $resultadoConsulta = mysqli_query($conexion, $consulta);

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
            </tr>";

    while ($fila = mysqli_fetch_assoc($resultadoConsulta)) {
        echo "<tr>
                <td>{$fila['id_plato']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['descripcion']}</td>
                <td>{$fila['precio']}</td>
              </tr>";
    }

    echo "</table>";

    echo "<br>
    <a href=''>Volver al formulario</a> | 
    <a href='tablaPlatos.php' target='_blank'>Ver tabla</a>";

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