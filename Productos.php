<?php
if(isset($_POST['']))  {


} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
</head>
<body>
    <h1>Insercion de productos</h1>
    <form name= "productos" method = "post" action = "Productos">
        <label for = "texto4"> Tipo: </label>
        
            <input name = "tipo" type = "radio" value = "Ingredientes"><label for= "tipo">Ingrendientes</label>
            <input name = "tipo" type = "radio" value = "Otros"><label for= "tipo">Otros</label>
            
        <br><br>
        <label for= "texto1">Código Producto: </label><input name = "Codigo" type = "text" value = "" required/>
        <br><br>
        <label for= "texto2">Nombre: </label><input name = "Nombre" type = "text" value = "" required/>
        <br><br>
        <label for = "texto3"> Cantidad: </label><input name = "Cantidad" type = "number" value = "" min = "1" required/>
        <br><br><br>

        <input name = "Añadir" type = "submit" value = "Añadir" />
    
    </form>
</body>
</html>
<?php
    }
?>