<?php
    if(isset($_GET['id'])){
        if($_GET['mode'] == 'room'){
            $tabel = "ruangan";
        }
        if($_GET['mode'] == 'device'){
            $tabel = "device";
        }
        include "connect.php";
        $sql = "DELETE FROM $tabel WHERE id_$tabel = $_GET[id]";
        $query = mysqli_query($conn, $sql);
        header("Location:index.php");
    }else{
        echo "id not received";
    }
?>