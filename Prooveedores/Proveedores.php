<?php
    if (isset($_POST['enviar'])){
        $nombre = $_POST ['nombre'];
        $cif = $_POST ['cif'];
        $direccion = $_POST ['direccion'];
        $telefono = $_POST ['telefono'];
        $correo = $_POST ['correo'];

        print ("Hola, ".$nombre.". Has rellenado el fomulario");
        print (" y tu CIF es: ".$cif.".");
        print ("</br> Vives en: ".$direccion.".");
        print ("</br> Tu teléfono es: ".$telefono.",");
        print (" y tu correo electrónico es: ".$correo.".");
    }else{


?>
<!DOCTYPE html>
<html lang = "es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Proveedores - La Trattoria</title>
    <link rel="stylesheet" href="estilo.css">
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
    <div id = "formulario">
        <h1>INSERCIÓN DE LOS PROVEEDORES</h1>
            <form method="POST">
                <div class="radio-group">
                    <label for = "texto1">Código_Proveedor: </label><input type = "text" name = "id" value = ""/>
                </div>
                    <label for = "texto2">Nombre: </label><input type = "text" name = "nombre" value = ""/>
                    <label for = "texto3">CIF: </label><input type = "text" name = "cif" value = ""/>
                    <label for = "texto4">Dirección: </label><input type = "text" name = "direccion" value = ""/>
                    <label for = "texto5">Teléfono: </label><input type = "text" name = "telefono" value = ""/>
                    <label for = "texto6">Contacto/Correo Electrónico: </label><input type = "text" name = "correo" value = ""/>
                    <label for = "boton1"></label><input type="submit" name="enviar" value="Nuevo Proveedor">
            </form>
    </div>
<?php
}
?>
</body>
</html>
