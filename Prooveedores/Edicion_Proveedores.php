<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla Productos</title>
    <link rel="stylesheet" href="estilo_proveedores.css">
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

    //Boton  MEMU ALMACEN
    print"<div class='contenedor-botones-superior'>";
        print"<a href='../Productos/MenuAlmacen.php' class='boton-menu'>Menu Almacén</a>";
    
    //BOTON AÑADIR PARA VOLVER AL FORMULARIO   
    print "<form action= 'Proveedores.php' method='post'>";
    print "<button id='boton_aniadir' type='submit' name = 'añadir'>Añadir</button>";
    print "</form>";
    print"</div>";

//ELIMINAR PRODUCTO
if(isset($_POST['eliminar'])){
    $id = $_POST['eliminar'];

    $conexion = mysqli_connect("localhost","root","")
    or die("No se pudo conectar al servidor");

    mysqli_select_db($conexion, "restaurante_italiano")
    or die ("No se pudo seleccionar la base de datos");

    $instruccionDelete = "DELETE FROM proveedor WHERE id_proveedor = '$id'";
    mysqli_query($conexion, $instruccionDelete)or die ("No se pudo eliminar el producto");

    mysqli_close($conexion);
}

//HACER EL SELECT DE LA TABLA
$conexion = mysqli_connect("localhost","root","")or die("No se pudo conectar al servidor");

$DB = mysqli_select_db($conexion, "restaurante_italiano")or die ("No se pudo seleccionar la base de datos");

$instruccion = "SELECT * FROM proveedor";
$consulta = mysqli_query($conexion, $instruccion)or die ("No se pudo hacer la consulta");

$nFilas = mysqli_num_rows($consulta);
if($nFilas > 0){
    print "<table border='1'>";
    print "<tr>";
    print "<th>Id_Proveedor</th>";
    print "<th>Nombre</th>";
    print "<th>CIF</th>";
    print "<th>Dirección</th>";
    print "<th>Teléfono</th>";
    print "<th>Contacto</th>";
    print "<th></th>";
    print "</tr>";

    for($i = 0; $i < $nFilas; $i++){
        $fila = mysqli_fetch_array($consulta);
        print "<tr>";
        print "<td>".$fila["id_proveedor"]."</td>";
        print "<td>".$fila["nombre"]."</td>";
        print "<td>".$fila["cif"]."</td>";
        print "<td>".$fila["direccion"]."</td>";
        print "<td>".$fila["telefono"]."</td>";
        print "<td>".$fila["contacto"]."</td>";

        print "<td>";

        // BOTÓN ELIMINAR
        print "<form action='Edicion_Proveedores.php' method='post' style='display:inline'>";
        print "<button type='submit' name='eliminar' value='".$fila["id_proveedor"]."'>Eliminar</button>";
        print "</form>";

        // NUEVO: BOTÓN PEDIR (Redirige a Realizar_Pedido.php)
        print "<form action='Realizar_Pedido.php' method='post' style='display:inline'>";
        print "<button type='submit' name='pedir' style='background:#2271b3; color:white;' value='".$fila["id_proveedor"]."'>Pedir</button>";
        print "</form>";

        print "</td>";
        print "</tr>";
    }
    print "</table>";

}

mysqli_close($conexion);

?>
</body>
</html>
