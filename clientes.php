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
                <th colspan="9"><h1>Listad de facturas de clientes</h1></th>
            </tr>
            <tr>
                <td>
                    <label>Numero Factura</label>
                    <input type="text" name="nombre">
                </td>
                <td>
                    <label>Nombre del cliente</label>
                    <input type="text" name="id_autor">
                </td>
                <td>
                    <input type="submit" name="enviar" value="BUSCAR">
                </td>
                <td>
                    <a href="clientes.php">Mostrar todas las facturas</a>
                </td>
                <td>
                    <a href="agregarclientes.php">Nueva Factura</a>
                </td>
                <td>
                    <a href="index2.php">Proveedores</a>
                </td>
            </tr>
        </table>
    </form>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tipo de Comprobante</th>
                <th>Nombre del Cliente</th>
                <th>Credito Fiscal</th>
                <th>Consumidor Final</th>
                <th>Numero de Comprobante</th>
                <th>Fecha del Comprobante</th>
                <th>Monto</th>
                <th>Factura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['enviar'])){
                    // Procesa la búsqueda
                    $nombre = $_POST['nombre'];
                    $editorial = $_POST['id_autor'];
                    $sql = "";

                    if(empty($nombre) && empty($editorial)){
                        echo "<script>
                            alert('Ingrese el numero de factura o el nombre del cliente que desea buscar');
                            setTimeout(function() {
                                location.assign('index2.php');
                            }, 0);
                        </script>";
                    } else {
                        if(empty($nombre)){
                            $sql = "SELECT * FROM autor WHERE nombre = '$editorial'";
                        } elseif(empty($editorial)){
                            $sql = "SELECT * FROM autor WHERE id_autor LIKE '%$nombre%'";
                        } else {
                            $sql = "SELECT * FROM autor WHERE nombre = '$editorial' AND id_autor LIKE '%$nombre%'";
                        }
                    }
                    
                    // Ejecuta la consulta solo si $sql tiene contenido
                    if ($sql != "") {
                        $resultado = mysqli_query($conexion, $sql);

                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while($filas = mysqli_fetch_assoc($resultado)){
                                ?>
                                <tr>
                                    <td> <?php echo $filas['id_autor']; ?> </td>
                                    <td> <?php echo $filas['t_comprobante']; ?> </td>
                                    <td> <?php echo $filas['nombre']; ?> </td>
                                    <td> <?php echo $filas['cf']; ?> </td>
                                    <td> <?php echo $filas['con_f']; ?> </td>
                                    <td> <?php echo $filas['n_comprobante']; ?> </td>
                                    <td> <?php echo $filas['f_comprobante']; ?> </td>
                                    <td> <?php echo $filas['monto']; ?> </td>
                                    <td> <a href="generar_pdf.php?id_autor=<?php echo $filas['id_autor']; ?>">Ver Factura</a></td>
                                    <td>
                                        <?php echo "<a href='editarclientes.php?id_autor=".$filas['id_autor']."'>Editar</a>"; ?>
                                        <p></p>
                                        <?php echo "<a href='eliminarcliente.php?id_autor=".$filas['id_autor']."' onclick='return confirmar()'>Eliminar</a>"; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='11'>No se encontraron resultados.</td></tr>";
                        }
                    }
                } else {
                    // Muestra todos los libros si no hay búsqueda activa
                    $sql = "SELECT * FROM autor";
                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        while($filas = mysqli_fetch_assoc($resultado)){
                            ?>
                            <tr>
                                <td> <?php echo $filas['id_autor']; ?> </td>
                                <td> <?php echo $filas['t_comprobante']; ?> </td>
                                <td> <?php echo $filas['nombre']; ?> </td>
                                <td> <?php echo $filas['cf']; ?> </td>
                                <td> <?php echo $filas['con_f']; ?> </td>
                                <td> <?php echo $filas['n_comprobante']; ?> </td>
                                <td> <?php echo $filas['f_comprobante']; ?> </td>
                                <td> <?php echo $filas['monto']; ?> </td>
                                <td> <a href="generar_pdf.php?id_autor=<?php echo $filas['id_autor']; ?>">Ver Factura</a></td>
                                <td>
                                    <?php echo "<a href='editarclientes.php?id_autor=".$filas['id_autor']."'>Editar</a>"; ?>
                                    <p></p>
                                    <?php echo "<a href='eliminarcliente.php?id_autor=".$filas['id_autor']."' onclick='return confirmar()'>Eliminar</a>"; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan='11'>Error al obtener los datos.</td></tr>";
                    }
                }
            ?>
        </tbody>
    </table>
</body>
</html>
