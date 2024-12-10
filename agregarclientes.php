<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <?php
    if (isset($_POST['enviar'])) {
        $tc = $_POST['t_comprobante'];
        $nombre = $_POST['nombre'];
        $fechana = $_POST['cf'];
        $libro = $_POST['con_f'];
        $nc = $_POST['n_comprobante'];
        $fc = $_POST['f_comprobante'];
        $monto = $_POST['monto'];


        include("conexion.php");

        // Insertar registros
        $sql = "INSERT INTO autor(t_comprobante, nombre, cf, con_f, n_comprobante,
        f_comprobante, monto) 
        VALUES('$tc','$nombre','$fechana','$libro','$nc','$fc','$monto')";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            // Datos ingresados correctamente
            echo "<script language='JavaScript'>
                    alert('Los datos fueron ingresados correctamente a la BD');
                    location.assign('clientes.php');
                  </script>";
        } else {
            // Error al ingresar datos
            echo "<script language='JavaScript'>
                    alert('ERROR: Los datos no fueron ingresados a la BD');
                    location.assign('clientes.php');
                  </script>";
        }
        mysqli_close($conexion);
    } else {
    ?>

    <h1>Agregar Nueva Factura</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Tipo de comprobante</label>
        <input type="text" name="t_comprobante"><br>
        <label>Nombre del cliente</label>
        <input type="text" name="nombre"><br>
        <label>Credito fiscal</label>
        <input type="text" name="cf"><br>
        <label>Consumidor final</label>
        <input type="text" name="con_f"><br>
        <label>Numero de comprobante</label>
        <input type="text" name="n_comprobante"><br>
        <label>Fecha del comprobante</label>
        <input type="text" name="f_comprobante"><br>
        <label>Monto</label>
        <input type="text" name="monto"><br>
        <input type="submit" name="enviar" value="Agregar">
        <a href="clientes.php">Regresar</a>
    </form>
    <?php
    }
    ?>
</body>
</html>
