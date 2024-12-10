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
        $autor = $_POST['np'];
        $libro = $_POST['fr'];
        $editorial = $_POST['formato'];

        include("conexion.php");

        // Insertar registros
        $directorio= "./pdf/";
    if(isset($_FILES['formato']) && $_FILES['formato']['error'] == 0){
            $nombreArchivo= $_FILES['formato']['name'];
            $rutaTemporal = $_FILES['formato']['tmp_name'];
            $rutaDestino= $directorio.basename($nombreArchivo);

            if(move_uploaded_file($rutaTemporal, $rutaDestino)){
                $sql = "INSERT INTO proveedores(np, fr, formato) 
        VALUES('$autor', '$libro','$nombreArchivo')";

        $resultado = mysqli_query($conexion, $sql);

        if ($resultado) {
            // Datos ingresados correctamente
            echo "<script language='JavaScript'>
                    alert('Los datos fueron ingresados correctamente a la BD');
                    location.assign('index2.php');
                  </script>";
        } else {
            // Error al ingresar datos
            echo "<script language='JavaScript'>
                    alert('ERROR: Los datos no fueron ingresados a la BD');
                    location.assign('index2.php');
                  </script>";
        }
        mysqli_close($conexion);
    } 

    }
}
    
    //     $sql = "INSERT INTO libros(id_autor, nombre_libro,editorial,fecha_publi,vista_previa) 
    //     VALUES('$autor', '$libro','$editorial','$fechaPubli','$vista')";

    //     $resultado = mysqli_query($conexion, $sql);

    //     if ($resultado) {
    //         // Datos ingresados correctamente
    //         echo "<script language='JavaScript'>
    //                 alert('Los datos fueron ingresados correctamente a la BD');
    //                 location.assign('index.php');
    //               </script>";
    //     } else {
    //         // Error al ingresar datos
    //         echo "<script language='JavaScript'>
    //                 alert('ERROR: Los datos no fueron ingresados a la BD');
    //                 location.assign('index.php');
    //               </script>";
    //     }
    //     mysqli_close($conexion);
    // } else {
    ?>

    <h1>Agregar Nuevo Libro</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
        <label>Nombre del proveedor</label>
        <input type="text" name="np"><br>
        <label>Fecha de registro</label>
        <input type="text" name="fr"><br>
        <label>Formato (PDF)</label>
        <input type="file" name="formato" accept="application/pdf" required><br>
        <input type="submit" name="enviar" value="Agregar">
        <a href="index2.php">Regresar</a>
    </form>
    <!-- 
    // }
    ?> -->
</body>
</html>
