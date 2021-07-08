<?php
    if(isset($_GET['id'])){
        if($_GET['mode'] == 'room'){
            $tabel = "ruangan";
        }
        if($_GET['mode'] == 'device'){
            $tabel = "device";
        }
    }else{
        echo "mode/id not received";
    }
?>