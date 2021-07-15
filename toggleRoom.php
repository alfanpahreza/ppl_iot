<?php
    include "send-antares.php";
    session_start();
    $started = $_SESSION['opened'];
    if($started){ //if it's opened and we want to clsoe the room
        $message = "Open";
        $started = false;
        //Send count data to database
        $sql = "SELECT * FROM `data pengunjung` WHERE id_ruangan = $_SESSION[room]";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
        
        
    }else{ //if it's closed and want to open the room
        $message = "Close";
        $started = true;
    }
    $_SESSION['opened'] = $started;
    $_SESSION['count'] = 0;
    echo $message;
?>