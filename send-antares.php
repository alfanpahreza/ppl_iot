<?php
    include('antares-php.php');

    function send($devicename, $appname, $data){
        $antares = new antares_php();
        $antares->set_key('29618496cc237e51:97bfc3c190e3e7b9');
        $yourdata = json_encode($data, true);
        //send one data
        $antares->send($yourdata, $devicename, $appname);
    }
?>