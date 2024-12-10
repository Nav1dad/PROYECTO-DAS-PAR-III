<?php
    $id=$_GET['id_autor'];
    include("conexion.php");

    // eliminar registro
    $sql="delete from autor where id_autor='".$id."'";
    $resultado=mysqli_query($conexion,$sql);
    if ($resultado) {
        echo "<script>
                alert('Los datos se eliminaron correctamente');
                setTimeout(function() {
                    location.assign('clientes.php');
                }, 500);  // 500 milisegundos de espera
              </script>";
    } else {
        echo "<script>
                alert('ERROR: Los datos no se eliminaron');
                setTimeout(function() {
                    location.assign('clientes.php');
                }, 500);
              </script>";
    }
?>