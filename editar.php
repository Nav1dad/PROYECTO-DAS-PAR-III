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
        if(isset($_POST['enviar'])){
            // aqui entra cuando se presiona el boton de enviar
            $id=$_POST['id_proveedor'];
            $autor = $_POST['np'];
            $libro = $_POST['fr'];
            
            //  vacio ""

            // if ($vista===""){
            //     update libro set autor, libro, editorial, fechapubli where id =1
            // }else {
            //     select vista from libro where id =1
            //     ejecute la consulta
            //     $fila =mysql_fecth_Asocc(ejecutar)
            //     unlink(.pdf/$fila['vista']);

            //     update libro set autor, libro, editorial, fechapubli, vista where id =1

            // }



            // update libros set
            $sql="UPDATE proveedores SET 
                np='".$autor."',
                fr='".$libro."'
                where id_proveedor='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            
            if ($resultado) {
                echo "<script>
                        alert('Los datos se actualizaron correctamente');
                        setTimeout(function() {
                            location.assign('index2.php');
                        }, 500);  // 500 milisegundos de espera
                      </script>";
            } else {
                echo "<script>
                        alert('ERROR: Los datos no se actualizaron');
                        setTimeout(function() {
                            location.assign('index2.php');
                        }, 500);
                      </script>";
            }
            
        mysqli_close($conexion);

        }else{
            // aqui entra si no se ha presionado el boton enviar
            $id=$_GET['id_proveedor'];
            $sql="SELECT * FROM proveedores where id_proveedor='".$id."'";
            $resultado=mysqli_query($conexion,$sql);

            $fila=mysqli_fetch_assoc($resultado);
            $autor=$fila["np"];
            $libro=$fila["fr"];;

            mysqli_close($conexion);

    ?>
    <h1>Editar factura</h1>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <label>Nombre del proveedor</label>
        <input type="text" name="np"
        value="<?php echo $autor; ?>"><br>
        <label>Fecha de registro</label>
        <input type="text" name="fr"
        value="<?php echo $libro; ?>"><br>


        <input type="hidden" name="id_proveedor"
        value="<?php echo $id; ?>">

        <input type="submit" name="enviar" value="Actualizar">
        <a href="index2.php">Regresar</a>
    </form>
    <?php
        }
    ?>
</body>
</html>