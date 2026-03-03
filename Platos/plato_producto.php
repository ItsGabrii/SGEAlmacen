<?php
$conexion = mysqli_connect("localhost", "root", "", "restaurante_italiano")
    or die("No se puede conectar a la base de datos");

$mensaje = "";

// ===================== ELIMINAR RELACIÓN =====================
if (isset($_POST['eliminar'])) {
    $id_plato    = intval($_POST['id_plato']);
    $id_producto = intval($_POST['id_producto']);

    $sql = "DELETE FROM plato_producto WHERE id_plato=$id_plato AND id_producto=$id_producto";
    if (mysqli_query($conexion, $sql)) {
        $mensaje = "<p style='color:green; text-align:center;'>Relación eliminada correctamente.</p>";
    } else {
        $mensaje = "<p style='color:red; text-align:center;'>Error al eliminar: " . mysqli_error($conexion) . "</p>";
    }
}

// ===================== INSERTAR NUEVA RELACIÓN =====================
if (isset($_POST['nueva_relacion'])) {
    $id_plato    = intval($_POST['id_plato']);
    $id_producto = intval($_POST['id_producto']);
    $cantidad    = floatval($_POST['cantidad']);

    $check = mysqli_query($conexion, "SELECT * FROM plato_producto WHERE id_plato=$id_plato AND id_producto=$id_producto");
    if (mysqli_num_rows($check) > 0) {
        $mensaje = "<p style='color:orange; text-align:center;'>⚠️ Ya existe esa relación plato-producto.</p>";
    } else {
        $sql = "INSERT INTO plato_producto (id_plato, id_producto, cantidad) VALUES ($id_plato, $id_producto, $cantidad)";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "<p style='color:green; text-align:center;'>✅ Relación añadida correctamente.</p>";
        } else {
            $mensaje = "<p style='color:red; text-align:center;'>Error al insertar: " . mysqli_error($conexion) . "</p>";
        }
    }
}

// ===================== MODIFICAR CANTIDAD =====================
if (isset($_POST['modificar'])) {
    $id_plato    = intval($_POST['id_plato']);
    $id_producto = intval($_POST['id_producto']);
    $nueva_cant  = floatval($_POST['nueva_cantidad']);

    $sql = "UPDATE plato_producto SET cantidad=$nueva_cant WHERE id_plato=$id_plato AND id_producto=$id_producto";
    if (mysqli_query($conexion, $sql)) {
        $mensaje = "<p style='color:green; text-align:center;'>✅ Cantidad actualizada correctamente.</p>";
    } else {
        $mensaje = "<p style='color:red; text-align:center;'>Error al modificar: " . mysqli_error($conexion) . "</p>";
    }
}

// ===================== REDUCIR STOCK POR PEDIDO =====================
if (isset($_POST['reducir_stock'])) {
    $id_pedido = intval($_POST['id_pedido']);

    // Obtenemos todos los platos del pedido y sus cantidades pedidas
    $sqlPedido = "SELECT id_plato, cantidad FROM pedido_plato WHERE id_pedido=$id_pedido";
    $resPlatos = mysqli_query($conexion, $sqlPedido);

    if (!$resPlatos || mysqli_num_rows($resPlatos) == 0) {
        $mensaje = "<p style='color:orange; text-align:center;'>⚠️ No se encontraron platos para ese pedido.</p>";
    } else {
        $errores = 0;

        while ($fila = mysqli_fetch_assoc($resPlatos)) {
            $id_plato        = $fila['id_plato'];
            $unidades_pedidas = $fila['cantidad']; // cuántas raciones se pidieron

            // Para cada plato, obtenemos sus ingredientes y la cantidad por ración
            $sqlIngredientes = "SELECT id_producto, cantidad FROM plato_producto WHERE id_plato=$id_plato";
            $resIngredientes = mysqli_query($conexion, $sqlIngredientes);

            while ($ing = mysqli_fetch_assoc($resIngredientes)) {
                $id_producto      = $ing['id_producto'];
                $cantidad_por_racion = $ing['cantidad'];

                // Total a descontar = cantidad_por_ración × unidades_pedidas
                $total_descontar = $cantidad_por_racion * $unidades_pedidas;

                $sqlUpdate = "UPDATE producto
                              SET cantidad = cantidad - $total_descontar
                              WHERE id_producto = $id_producto";

                if (!mysqli_query($conexion, $sqlUpdate)) {
                    $errores++;
                }
            }
        }

        if ($errores == 0) {
            $mensaje = "<p style='color:green; text-align:center;'>✅ Stock reducido correctamente para el pedido #$id_pedido.</p>";
        } else {
            $mensaje = "<p style='color:red; text-align:center;'>Se produjeron $errores errores al actualizar el stock.</p>";
        }
    }
}

// ===================== CARGAR DATOS PARA LA VISTA =====================
$resRelaciones = mysqli_query($conexion,
    "SELECT pp.id_plato, p.nombre AS nombre_plato,
            pp.id_producto, pr.nombre AS nombre_producto,
            pp.cantidad, pr.cantidad AS stock_actual
     FROM plato_producto pp
     JOIN plato    p  ON pp.id_plato    = p.id_plato
     JOIN producto pr ON pp.id_producto = pr.id_producto
     ORDER BY p.nombre, pr.nombre");

$resPlatos    = mysqli_query($conexion, "SELECT id_plato, nombre FROM plato ORDER BY nombre");
$resProductos = mysqli_query($conexion, "SELECT id_producto, nombre FROM producto ORDER BY nombre");
$resPedidos   = mysqli_query($conexion, "SELECT id_pedido, fecha FROM pedido ORDER BY fecha DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Plato-Producto - La Trattoria</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<!-- HEADER -->
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

<!-- BOTONES SUPERIORES -->
<div class="contenedor-botones-superior">
    <a href="../Productos/MenuAlmacen.php" class="boton-menu">Menú Almacén</a>
</div>

<?php echo $mensaje; ?>

<!-- FORMULARIO NUEVA RELACIÓN -->
<div id="formulario">
    <h1>ASIGNAR INGREDIENTE A PLATO</h1>

    <form method="POST">
        <label>Plato:</label>
        <select name="id_plato" required>
            <option value="">-- Selecciona un plato --</option>
            <?php while ($f = mysqli_fetch_assoc($resPlatos)): ?>
                <option value="<?= $f['id_plato'] ?>"><?= htmlspecialchars($f['nombre']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Producto / Ingrediente:</label>
        <select name="id_producto" required>
            <option value="">-- Selecciona un producto --</option>
            <?php while ($f = mysqli_fetch_assoc($resProductos)): ?>
                <option value="<?= $f['id_producto'] ?>"><?= htmlspecialchars($f['nombre']) ?></option>
            <?php endwhile; ?>
        </select>

        <label>Cantidad necesaria por ración:</label>
        <input type="number" name="cantidad" step="0.01" min="0.01" required>

        <input type="submit" name="nueva_relacion" value="Añadir Relación">
    </form>
</div>

<!-- FORMULARIO REDUCIR STOCK POR PEDIDO -->
<div id="formulario" style="margin-top: 20px;">
    <h1>REDUCIR STOCK POR PEDIDO</h1>

    <form method="POST">
        <label>Selecciona el pedido:</label>
        <select name="id_pedido" required>
            <option value="">-- Selecciona un pedido --</option>
            <?php while ($p = mysqli_fetch_assoc($resPedidos)): ?>
                <option value="<?= $p['id_pedido'] ?>">
                    Pedido #<?= $p['id_pedido'] ?> — <?= $p['fecha'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <input type="submit" name="reducir_stock" value="Descontar Stock">
    </form>
</div>

<!-- TABLA DE RELACIONES -->
<br>
<table>
    <thead>
        <tr>
            <th>Plato</th>
            <th>Ingrediente / Producto</th>
            <th>Cantidad por ración</th>
            <th>Stock actual</th>
            <th>Modificar cantidad</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php if (mysqli_num_rows($resRelaciones) == 0): ?>
            <tr><td colspan="6">No hay relaciones registradas aún.</td></tr>
        <?php else: ?>
            <?php while ($fila = mysqli_fetch_assoc($resRelaciones)): ?>
            <tr>
                <td><?= htmlspecialchars($fila['nombre_plato']) ?></td>
                <td><?= htmlspecialchars($fila['nombre_producto']) ?></td>
                <td><?= $fila['cantidad'] ?></td>
                <td><?= $fila['stock_actual'] ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id_plato"    value="<?= $fila['id_plato'] ?>">
                        <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                        <input type="number" name="nueva_cantidad" value="<?= $fila['cantidad'] ?>"
                               step="0.01" min="0.01" style="width:75px; margin:0 6px 0 0;">
                        <button type="submit" name="id_producto">Guardar</button>
                    </form>
                </td>
                <td>
                    <form method="POST" onsubmit="return confirm('¿Eliminar esta relación?')">
                        <input type="hidden" name="id_plato"    value="<?= $fila['id_plato'] ?>">
                        <input type="hidden" name="id_producto" value="<?= $fila['id_producto'] ?>">
                        <button type="submit" name="eliminar">Eliminar</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </tbody>
</table>
<br><br>

</body>
</html>
<?php mysqli_close($conexion); ?>
