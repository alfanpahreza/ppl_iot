<?php
    include "connect.php";
    $sql = "SELECT * FROM `data pengunjung` ORDER BY id_data DESC";
    $result = mysqli_query($conn, $sql);
    $days = array();
    $i = 0;
    while($i != 7){
        $row = mysqli_fetch_assoc($result);
        $timestamp = strtotime($row['tanggal']);
        $day = date('D', $timestamp);
        $days[] = $day;
        $i++;
    };
    $days = array_reverse($days);
    foreach($days as $dayName){
        echo $dayName;
    }
?>