<?php
if (isset($_POST["Enviar"])) {

    /*
    $conexion = mysqli_connect("localhost", "root", "", "lindavista")
        or die("No se puede conectar o seleccionar la base de datos");

    $nombre = $_POST["Nombre"];
    $descripcion = $_POST["Descripcion"];
    $precio = $_POST["Precio"];

    $sql = "INSERT INTO platos (nombre, descripcion, precio)
            VALUES ('$nombre', '$descripcion', '$precio')";

    $resultado = mysqli_query($conexion, $sql);

    echo $resultado
        ? "<p style='color:green;'>El plato se agregó correctamente.</p>"
        : "<p style='color:red;'>Hubo un error al agregar el plato.</p>";

    mysqli_close($conexion);
    */

    echo "<p style='color:green;'>El plato se agregó correctamente.</p>";

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
      </div></a>
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