<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Productos</title>
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

<?php
    /* ===================== ELIMINAR PRODUCTO ===================== */
    if(isset($_POST['eliminar'])){
        $id_producto = $_POST['eliminar'];

        $conexion = mysqli_connect("localhost","root","")
        or die("No se pudo conectar al servidor");

        mysqli_select_db($conexion, "almacen")
        or die ("No se pudo seleccionar la base de datos");

        $instruccionDelete = "DELETE FROM productos WHERE id_producto = '$id_producto'";
        mysqli_query($conexion, $instruccionDelete)
        or die ("No se pudo eliminar el producto");

        mysqli_close($conexion);
    }

    /* ===================== MOSTRAR TABLA ===================== */

    $conexion = mysqli_connect("localhost","root","")
    or die("No se pudo conectar al servidor");

    $DB = mysqli_select_db($conexion, "almacen")
    or die ("No se pudo seleccionar la base de datos");

    $instruccion = "select * from productos";
    $consulta = mysqli_query($conexion, $instruccion)
    or die ("No se pudo hacer la consulta");

    $nFilas = mysqli_num_rows($consulta);
    if($nFilas > 0){
        print "<form action='TablaProductos.php' method='post'>";
        print "<table border='1'>";
        print "<tr>";

        print "<th>Nombre</th>";
        print "<th>Tipo</th>";
        print "<th>id_producto</th>";
        print "<th>cod_proveedor</th>";
        print "<th>Cantidad</th>";
        print "<th>Precio</th>";
        print "<th></th>";
        print "</tr>";

        for($i = 0; $i < $nFilas; $i++){
            $fila = mysqli_fetch_array($consulta);
            print "<tr>";
            print "<td>".$fila["nombre"]."</td>";
            print "<td>".$fila["tipo"]."</td>";
            print "<td>".$fila["id_producto"]."</td>";
            print "<td>".$fila["cod_proveedor"]."</td>";
            print "<td>".$fila["cantidad"]."</td>";
            print "<td>".$fila["precio"]."</td>";

            print "<td>";

            print "<form action='ModificarProducto.php' method='post' style='display:inline'>";
            print "<button type='submit' name='id_producto' value='".$fila["id_producto"]."'>Modificar</button>";
            print "</form>";

            print "<button type='submit' name='eliminar' value='".$fila["id_producto"]."'>Eliminar</button>";

            print "</td>";
            print "</tr>";
        }
        print "</table>";
        print "</form>";
    }

    mysqli_close($conexion);
?>

</body>
</html>
