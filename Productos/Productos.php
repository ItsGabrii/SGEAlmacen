<?php
if (isset($_POST['Añadir'])) {
    // CONEXIÓN
    // INSERT A LA BBDD 
    echo "<h2 style='text-align:center;color:#1f7a1f;margin-top:50px'>
            Producto agregado correctamente
          </h2>";
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inserción de Productos</title>

  <!-- CSS EXTERNO -->
  <link rel="stylesheet" href="estilo.css">
</head>

<body>

  <div id="formulario">
    <h1>Inserción de productos</h1>

    <form method="post">
      <div class="radio-group">
        <label>Tipo de producto:</label><br><br>
        <input type="radio" name="tipo" value="Ingredientes" required> Ingredientes
        &nbsp&nbsp&nbsp&nbsp<input type="radio" name="tipo" value="Otros"> Otros
      </div>

      <label>Código Producto:</label>
      <input type="text" name="Codigo" required>

      <label>Nombre:</label>
      <input type="text" name="Nombre" required>

      <label>Cantidad:</label>
      <input type="number" name="Cantidad" min="1" required>

      <input type="submit" name="Añadir" value="Agregar">
    </form>
  </div>

</body>
</html>
<?php 
} 
?>
