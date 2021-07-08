<?php
    if(isset($_GET['id'])){
        if($_GET['mode'] == 'room'){
            $tabel = "ruangan";
            $back = "roomList.php";
        }
        if($_GET['mode'] == 'device'){
            $tabel = "hardware";
            $back = "deviceList.php";
        }
        include "connect.php";
        $sql = "DELETE FROM $tabel WHERE id_$tabel = $_GET[id]";
        $query = mysqli_query($conn, $sql);
        header("Location:index.php?content=$back");
    }else{
        echo "id not received";
    }
?>