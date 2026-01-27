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
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERCIÓN DE LOS PROVEEDORES</title>

</head>
<body>
    <div id = "formulario">
        <h2>INSERCIÓN DE LOS PROVEEDORES</h2>
            <form action="Proveedores.php" method="POST">
                <label for = "texto1">Código_Proveedor: </label><input type = "text" name = "id" value = ""/>
                </br></br>
                <label for = "texto2">Nombre: </label><input type = "text" name = "nombre" value = ""/>
                </br></br>
                <label for = "texto3">CIF: </label><input type = "text" name = "cif" value = ""/>
                </br></br>
                <label for = "texto4">Dirección: </label><input type = "text" name = "direccion" value = ""/>
                </br></br>
                <label for = "texto5">Teléfono: </label><input type = "text" name = "telefono" value = ""/>
                </br></br>
                <label for = "texto6">Contacto/Correo Electrónico: </label><input type = "text" name = "correo" value = ""/>
                </br></br>
                <label for = "boton1"></label><input type="submit" name="enviar" value="ENVIAR">
            </form>
    </div>
<?php
}
?>
</body>
</html>
