<?php
include "../db/dbconn.php"; 


if(isset($_POST['submit'])) {

    if( isset($_POST['imgeid']) ) {
    

        $id = $_POST['imgeid'];  
    }
    
    $query = "DELETE from ads WHERE idPublicidad='$id' ";

    $run = mysqli_query($conn,$query) or die(mysqli_error($conn));

    if($run) {
        echo " Anuncio eliminado";

        header("location:../ads.php?id=$id&mensaje=hecho");

    } else {
        echo ' No se puede editar, error desconocido.' ;
        header("location:../ads.php?id=$id&mensaje=error");
    }

} else {
    echo " Ingresa todos los datos";
    header("location:../ads.php?id=$id&mensaje=error");
}

?>





