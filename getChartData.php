<?php
    include "connect.php";
    $sql = "SELECT * FROM `data pengunjung` ORDER BY id_data DESC";
    $result = mysqli_query($conn, $sql);
    $datas = array();
    $i = 0;
    while($i != 7){
        $row = mysqli_fetch_assoc($result);
        $datas[] = $row['jumlah_masuk'];
        $i++;
    };
    $datas = array_reverse($datas);
    echo json_encode($datas);
?>