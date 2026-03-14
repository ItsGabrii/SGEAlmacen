<?php
    if (isset($_POST['enviar'])){
        $id = $_POST ['codigo_proveedor'];
        $nombre = $_POST ['nombre'];
        $cif = $_POST ['cif'];
        $direccion = $_POST ['direccion'];
        $telefono = $_POST ['telefono'];
        $contacto = $_POST ['correo'];

        $conexion = mysqli_connect("localhost","root","")or die("No se puede conectar.");
        mysqli_select_db($conexion,"restaurante_italiano")or die("No se puede seleccionar la base de datos.");

        $instruccionInsert = "INSERT INTO proveedores (id_proveedor, nombre, cif, direccion, telefono, correo) VALUES ('$id', '$nombre', '$cif', '$direccion', '$telefono', '$contacto')";
        $consultaInstruccionInsert = mysqli_query($conexion, $instruccionInsert)or die("No se ha podido insertar el proveedor.");

        $instruccionSelect = "SELECT * FROM proveedores WHERE id_proveedor = '$id'";
        $consultaInstruccionSelect = mysqli_query ($conexion, $instruccionSelect)or die("No se puede realizar la consulta con éxito.");

        $nfilas = mysqli_num_rows($consultaInstruccionSelect);

        if ($nfilas > 0){
            echo '<link rel = stylesheet href = estilo_proveedores.css>';
            echo "<h2>NUEVO PROVEEDOR AÑADIDO AL ALMACÉN: </h2>";
            echo "<table border = '1'>";
            echo "<tr>
                    <th>Id_Proveedor</th>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Contacto</th>
                  </tr>";
            for ($i = 0; $i < $nfilas; $i++){
                $fila = mysqli_fetch_array ($consultaInstruccionSelect);
                echo "<tr>";
                    echo "<td>".$fila['id_proveedor']."</td>";
                    echo "<td>".$fila['nombre']."</td>";
                    echo "<td>".$fila['cif']."</td>";
                    echo "<td>".$fila['direccion']."</td>";
                    echo "<td>".$fila['telefono']."</td>";
                    echo "<td>".$fila['correo']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        print "<div class='contenedor-botones-superior'>";
        print"<a href='Edicion_Proveedores.php' class='boton-menu'>Editar Proveedores</a>";

        print "<form action= 'Proveedores.php' method='post'>";
        print "<button id='boton_aniadir' type='submit' name = 'añadir'>Añadir</button>";
        print "</form>";
        print"</div>";
                    
        }else{
            print "No se ha insertado el nuevo proveedor correctamente o ya existe.";
        }
            mysqli_close($conexion);
    } else {              
?>
<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Proveedores - La Trattoria</title>
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
    <div class='contenedor-botones-superior'>
        <br><a href='MenuAlmacen.php' class='boton-menu'>Menu Almacén</a>
    </div>
    <div id = "formulario">
        <h1>INSERCIÓN DE LOS PROVEEDORES</h1>
            <form method="POST">
                <div class="radio-group">
                    <label for = "texto1">Código Proveedor: </label><input type = "text" name = "codigo_proveedor" value = ""/>
                </div>
                    <label for = "texto2">Nombre: </label><input type = "text" name = "nombre" value = ""/>
                    <label for = "texto3">CIF: </label><input type = "text" name = "cif" value = ""/>
                    <label for = "texto4">Dirección: </label><input type = "text" name = "direccion" value = ""/>
                    <label for = "texto5">Teléfono: </label><input type = "text" name = "telefono" value = ""/>
                    <label for = "texto6">Contacto/Correo Electrónico: </label><input type = "text" name = "correo" value = ""/>
                    <label for = "boton1"></label><input type="submit" name="enviar" value="Nuevo Proveedor">
            </form>
    </div>
    <br></br>
<?php
    }
?>
</body>
</html>
