<?php
    include("conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <?php
        if (isset($_POST['enviar'])) {
            $id = $_POST['id_autor'];
            $tc = $_POST['t_comprobante'];
            $nombre = $_POST['nombre'];
            $cf = $_POST['cf'];
            $conf = $_POST['con_f'];
            $nc = $_POST['n_comprobante'];
            $fc = $_POST['f_comprobante'];
            $monto = $_POST['monto'];

            // Consulta actualizada correctamente
            $sql = "UPDATE autor SET
                    t_comprobante = '".$tc."', 
                    nombre = '".$nombre."',
                    cf = '".$cf."',
                    con_f = '".$conf."',
                    n_comprobante = '".$nc."',
                    f_comprobante = '".$fc."',
                    monto = '".$monto."'
                    WHERE id_autor = '".$id."'";
            $resultado = mysqli_query($conexion, $sql);

            if ($resultado) {
                echo "<script>
                        alert('Los datos se actualizaron correctamente');
                        setTimeout(function() {
                            location.assign('clientes.php');
                        }, 500);
                      </script>";
            } else {
                echo "<script>
                        alert('ERROR: Los datos no se actualizaron');
                        setTimeout(function() {
                            location.assign('clientes.php');
                        }, 500);
                      </script>";
            }

            mysqli_close($conexion);

        } else {
            $id = $_GET['id_autor'];
            $sql = "SELECT * FROM autor WHERE id_autor = '".$id."'";
            $resultado = mysqli_query($conexion, $sql);

            $fila = mysqli_fetch_assoc($resultado);

            // Extraer valores de la consulta para mostrar en el formulario
            $tc = $fila['t_comprobante'];
            $nombre = $fila['nombre'];
            $cf = $fila['cf'];
            $conf = $fila['con_f'];
            $nc = $fila['n_comprobante'];
            $fc = $fila['f_comprobante'];
            $monto = $fila['monto'];

            mysqli_close($conexion);
    ?>
    <h1>Editar Autor</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Tipo de comprobante</label>
        <input type="text" name="t_comprobante" value="<?php echo $tc; ?>"><br>
        <label>Nombre del cliente</label>
        <input type="text" name="nombre" value="<?php echo $nombre; ?>"><br>
        <label>Credito fiscal</label>
        <input type="text" name="cf" value="<?php echo $cf; ?>"><br>
        <label>Consumidor final</label>
        <input type="text" name="con_f" value="<?php echo $conf; ?>"><br>
        <label>Numero de comprobante</label>
        <input type="text" name="n_comprobante" value="<?php echo $nc; ?>"><br>
        <label>Fecha del comprobante</label>
        <input type="text" name="f_comprobante" value="<?php echo $fc; ?>"><br>
        <label>Monto</label>
        <input type="text" name="monto" value="<?php echo $monto; ?>"><br>

        <input type="hidden" name="id_autor" value="<?php echo $id; ?>">
        <input type="submit" name="enviar" value="Actualizar">
        <a href="clientes.php">Regresar</a>
    </form>
    <?php
        }
    ?>
</body>
</html>
