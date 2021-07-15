<?php
    include "send-antares.php";
    include "connect.php";
    session_start();
    $started = $_SESSION['opened'];
    if($started){ //if it's opened and we want to clsoe the room
        $message = "Open";
        $started = false;
        //Send count data to database
        $sql = "SELECT * FROM `data pengunjung` WHERE id_ruangan = $_SESSION[room]";
        $query = mysqli_query($conn, $sql);
        $found = false;
        $today = date("Y-m-d");
        $jumlah_masuk = 0;
        while($row = mysqli_fetch_assoc($query)){
            if($today == $row['tanggal']){
                $found = true;
                $jumlah_masuk = $row['jumlah_masuk'] + $_SESSION['count'];
                break;
            }
        }
        if($found){
            $sql = "UPDATE `data pengunjung` SET `jumlah_masuk`= $_SESSION[count]";
        }else{
            $sql = "INSERT INTO `data pengunjung` ( `tanggal`, `jumlah_masuk`, `id_ruangan`) VALUES ($today,$jumlah_masuk,$_SESSION[room])";
        } 
    }else{ //if it's closed and want to open the room
        $message = "Close";
        $started = true;
    }
    $sql = "SELECT * FROM `ruangan` JOIN `hardware` ON ruangan.id_ruangan = hardware.id_ruangan WHERE ruangan.id_ruangan = 1001";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    send($row['device_name'],$row['application_name'],array("People"=>"$_SESSION[count]"));
    $_SESSION['opened'] = $started;
    $_SESSION['count'] = 0;
    echo $message;
?>