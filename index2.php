<?php
    include ('conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de libros</title>
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estás seguro de que quieres eliminar los datos?');
        }
    </script>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <table>
            <tr>
                <th colspan="9"><h1>Lista de facturas de proveedores</h1></th>
            </tr>
            <tr>
                <td>
                    <label>Id factura:</label>
                    <input type="text" name="np">
                </td>
                <td>
                    <label>proveedor:</label>
                    <input type="text" name="id_proveedor">
                </td>
                <td>
                    <input type="submit" name="enviar" value="BUSCAR">
                </td>
                <td>
                    <a href="index2.php">Mostrar todas las facturas de proveedores</a>
                </td>
                <td>
                    <a href="agregar.php">Nueva Factura</a>
                </td>
                <td>
                    <a href="clientes.php">clientes</a>
                </td>
            </tr>
        </table>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del proveedor</th>
                <th>Fecha de registro</th>
                <th>Formato</th>
                <th>Factura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['enviar'])){
                    // Procesa la búsqueda
                    $nombre = $_POST['np'];
                    $editorial = $_POST['id_proveedor'];
                    $sql = "";

                    if(empty($nombre) && empty($editorial)){
                        echo "<script>
                            alert('Ingrese el el numero de factura o el nombre del proveedor que deses buscar');
                            setTimeout(function() {
                                location.assign('index2.php');
                            }, 0);
                        </script>";
                    } else {
                        if(empty($nombre)){
                            $sql = "SELECT * FROM proveedores WHERE np = '$editorial'";
                        } elseif(empty($editorial)){
                            $sql = "SELECT * FROM proveedores WHERE id_proveedor LIKE '%$nombre%'";
                        } else {
                            $sql = "SELECT * FROM proveedores WHERE np = '$editorial' AND id_proveedor LIKE '%$nombre%'";
                        }
                    }
                    
                    // Ejecuta la consulta solo si $sql tiene contenido
                    if ($sql != "") {
                        $resultado = mysqli_query($conexion, $sql);

                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while($filas = mysqli_fetch_assoc($resultado)){
                                ?>
                                <tr>
                                    <td> <?php echo $filas['id_proveedor']; ?> </td>
                                    <td> <?php echo $filas['np']; ?> </td>
                                    <td> <?php echo $filas['fr']; ?> </td>
                                    <td> <?php echo $filas['formato']; ?> </td>
                                    <td> <a href="./pdf/<?php echo $filas['formato']; ?>">Ver Factura</a></td>
                                    <td>
                                        <?php echo "<a href='editar.php?id_proveedor=".$filas['id_proveedor']."'>Editar</a>"; ?>
                                        <p></p>
                                        <?php echo "<a href='eliminar.php?id_proveedor=".$filas['id_proveedor']."' onclick='return confirmar()'>Eliminar</a>"; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='9'>No se encontraron resultados.</td></tr>";
                        }
                    }
                } else {
                    // Muestra todos los libros si no hay búsqueda activa
                    $sql = "SELECT * FROM proveedores";
                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        while($filas = mysqli_fetch_assoc($resultado)){
                            ?>
                            <tr>
                                <td> <?php echo $filas['id_proveedor']; ?> </td>
                                <td> <?php echo $filas['np']; ?> </td>
                                <td> <?php echo $filas['fr']; ?> </td>
                                <td> <?php echo $filas['formato']; ?> </td>
                                <td> <a href="./pdf/<?php echo $filas['formato']; ?>">Ver Factura</a></td>
                                <td>
                                    <?php echo "<a href='editar.php?id_proveedor=".$filas['id_proveedor']."'>Editar</a>"; ?>
                                    <p></p>
                                    <?php echo "<a href='eliminar.php?id_proveedor=".$filas['id_proveedor']."' onclick='return confirmar()'>Eliminar</a>"; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>Error al obtener los datos.</td></tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>
